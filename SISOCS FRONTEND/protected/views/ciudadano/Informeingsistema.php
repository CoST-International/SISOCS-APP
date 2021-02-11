<?php
/* @var $this CiudadanoController */
  require_once dirname(__FILE__).'/../../../protected/extensions/analytics/vendor/autoload.php';
  $command = Yii::app()->db->createCommand("CALL sp_portal_indicadores();");
  $ind = $command->queryAll();
?>
  <?php

$analytics = initializeAnalytics();
$response = getReport($analytics);
//printResults($response);
pivotRequest($analytics);


function initializeAnalytics()
{
    // Creates and returns the Analytics Reporting service object.

    // Use the developers console and download your service account
    // credentials in JSON format. Place them in this directory or
    // change the key file location if necessary.
    $KEY_FILE_LOCATION = dirname(__FILE__) . '/analytics_key.json';

    // Create and configure a new client object.
    $client = new Google_Client();
    $client->setApplicationName("SISOCS Analytics");
    $client->setAuthConfig($KEY_FILE_LOCATION);
    $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
    $analytics = new Google_Service_AnalyticsReporting($client);

    return $analytics;
}

function getReport($analytics)
{

  // Replace with your view ID, for example XXXX.
    $VIEW_ID = "169344310";

    // Create the DateRange object.
    $dateRange = new Google_Service_AnalyticsReporting_DateRange();
    $dateRange->setStartDate("7daysAgo");
    $dateRange->setEndDate("today");

    // Create the Metrics object.
    $users = new Google_Service_AnalyticsReporting_Metric();
    $users->setExpression("ga:users");
    $users->setAlias("Users");

    // Create the ReportRequest object.
    $request = new Google_Service_AnalyticsReporting_ReportRequest();
    $request->setViewId($VIEW_ID);
    $request->setDateRanges($dateRange);
    $request->setMetrics(array($users));

    $date = new Google_Service_AnalyticsReporting_Dimension();
    $date->setName("ga:nthDay");
    // Create the Metrics object.
    $sessions = new Google_Service_AnalyticsReporting_Metric();
    $sessions->setExpression("ga:1dayUsers");
    $sessions->setAlias("One Day User");

    // Create the ReportRequest object.
    $requestTotalUsers = new Google_Service_AnalyticsReporting_ReportRequest();
    $requestTotalUsers->setViewId($VIEW_ID);
    $requestTotalUsers->setDateRanges($dateRange);
    $requestTotalUsers -> setDimensions(array($date));
    $requestTotalUsers->setMetrics(array($sessions));

    $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
    $body->setReportRequests(array( $request,$requestTotalUsers));
    return $analytics->reports->batchGet($body);
}

function pivotRequest(&$analyticsreporting) {

  $VIEW_ID = "169344310";
  // Create the DateRange object.
  $dateRange = new Google_Service_AnalyticsReporting_DateRange();
  $dateRange->setStartDate("2017-06-15");
  $dateRange->setEndDate("2018-12-31");

  // Create the Metric objects.
  $sessions = new Google_Service_AnalyticsReporting_Metric();
  $sessions->setExpression("ga:sessions");
  $sessions->setAlias("sessions");

  $pageviews = new Google_Service_AnalyticsReporting_Metric();
  $pageviews->setExpression("ga:pageviews");
  $pageviews->setAlias("pageviews");

  // Create the Dimension objects.
  $browser = new Google_Service_AnalyticsReporting_Dimension();
  $browser->setName("ga:browser");

  $campaign = new Google_Service_AnalyticsReporting_Dimension();
  $campaign->setName("ga:campaign");

  $age = new Google_Service_AnalyticsReporting_Dimension();
  $age->setName("ga:userAgeBracket");

  // Create the Pivot object.
  $pivot = new Google_Service_AnalyticsReporting_Pivot();
  $pivot->setDimensions(array($age));
  $pivot->setMaxGroupCount(3);
  $pivot->setStartGroup(0);
  $pivot->setMetrics(array($sessions, $pageviews));

  // Create the ReportRequest object.
  $request = new Google_Service_AnalyticsReporting_ReportRequest();
  $request->setViewId($VIEW_ID);
  $request->setDateRanges(array($dateRange));
  $request->setDimensions(array($browser, $campaign));
  $request->setPivots(array($pivot));
  $request->setMetrics(array($sessions));

  // Create the GetReportsRequest object.
  $getReport = new Google_Service_AnalyticsReporting_GetReportsRequest();
  $getReport->setReportRequests(array($request));

  // Call the batchGet method.
  $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
  $body->setReportRequests( array($request) );
  $response = $analyticsreporting->reports->batchGet( $body );

  printResults($response->getReports());
}

function printResults($reports)
{
    for ($reportIndex = 0; $reportIndex < count($reports); $reportIndex++) {
        $report = $reports[ $reportIndex ];
        $header = $report->getColumnHeader();
        $dimensionHeaders = $header->getDimensions();
        $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
        $rows = $report->getData()->getRows();

        for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
            $row = $rows[ $rowIndex ];
            $dimensions = $row->getDimensions();
            $metrics = $row->getMetrics();
            for ($i = 0; $i < count($dimensionHeaders) && $i < count($dimensions); $i++) {
                echo "<p>".($dimensionHeaders[$i] . ": " . $dimensions[$i] . "\n .</p>");
            }

            for ($j = 0; $j < count($metricHeaders) && $j < count($metrics); $j++) {
                $entry = $metricHeaders[$j];
                $values = $metrics[$j];
                echo("Metric type: " . $entry->getType() . "\n");
                for ($valueIndex = 0; $valueIndex < count($values->getValues()); $valueIndex++) {
                    $value = $values->getValues()[ $valueIndex ];
                    echo($entry->getName() . ": " . $value . "\n");
                }
            }
        }
    }
}
?>
    <div class="informe_sistema">
      <div class="row">
        <h1 class="section-title wow fadeIn animated" data-wow-delay=".2s">
          Informe Del Sistema
        </h1>
        <p class="section-subcontent"></p>
        <hr class="lineOne">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="coolBox">
            <h5>
              <strong style="font-size:.8em">Proyectos:</strong>
              <label style="float:right;font-size:.8em">
                <?php echo $ind[0]['proyectos'];?>
              </label>
            </h5>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="coolBox">
            <h5>
              <strong style="font-size:.8em">Contratos:</strong>
              <label style="float:right;font-size:.8em">USD.
                <?php $sum=Yii::app()->db->createCommand()
                  ->select('sum(precioLPS)')
                  ->from('cs_contratacion')
                  ->queryScalar();
                  echo number_format(($ind[0]['contratado']/1000000), 2). "M";
                  ?>
              </label>
            </h5>
          </div>
        </div>

      </div>
      <?php Yii::app()->counter->refresh();?>
      <div class="row">

        <div class="contratosGraph">
          <div class="col-md-6 col-x-12 col-sm-12" style="background:#f3f3f3;margin-top:20px">
            <div id
          </div>
          <div class="col-md-6 col-x-12 col-sm-12" style="background:#f3f3f3;margin-top:20px">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="table_user_report">
          <div class="card-deck">

            <div class="card">
              <img class="card-img-top" src="<?php echo Yii::app()->baseUrl.'/themes/blackboot/assets/img/connected_user.png' ?>" alt="Card image cap">
              <div class="card-block">
                <h4 class="card-title">Usuarios Conectados</h4>
                <hr>
                <p class="card-text">
                  <?php echo Yii::app()->counter->getOnline(); ?>
                </p>
              </div>
            </div>

            <div class="card">
              <img class="card-img-top" src="<?php echo Yii::app()->baseUrl.'/themes/blackboot/assets/img/today_user.png' ?>" alt="Card image cap">
              <div class="card-block">
                <h4 class="card-title">Usuarios que se conectaron hoy</h4>
                <hr>
                <p class="card-text">
                  <?php echo Yii::app()->counter->getToday(); ?>
                </p>
              </div>
            </div>

            <div class="card">
              <img class="card-img-top" src="<?php echo Yii::app()->baseUrl.'/themes/blackboot/assets/img/yesterday_user.png' ?>" alt="Users Yesterday">
              <div class="card-block">
                <h4 class="card-title">Usuarios que se conectaron ayer</h4>
                <hr>
                <p class="card-text">
                  <?php echo Yii::app()->counter->getYesterday(); ?>
                </p>
              </div>
            </div>
          </div>
          <div class="card-deck" style="margin-top:30px">
            <div class="card">
              <img class="card-img-top" src="<?php echo Yii::app()->baseUrl.'/themes/blackboot/assets/img/total_user.png' ?>" alt="Total Users">
              <div class="card-block">
                <h4 class="card-title">Total de usuarios que se han conectado</h4>
                <hr>
                <p class="card-text">
                  <?php echo Yii::app()->counter->getTotal(); ?>
                </p>
              </div>
            </div>

            <div class="card">
              <img class="card-img-top" src="<?php echo Yii::app()->baseUrl.'/themes/blackboot/assets/img/max_user.png' ?>" alt="Card image cap">
              <div class="card-block">
                <h4 class="card-title">Máximo de usuarios conectados</h4>
                <hr>
                <p class="card-text">
                  <?php echo Yii::app()->counter->getMaximal(); ?>
                </p>
              </div>
            </div>

            <div class="card">
              <img class="card-img-top" src="<?php echo Yii::app()->baseUrl.'/themes/blackboot/assets/img/date_user.png' ?>" alt="Card image cap">
              <div class="card-block">
                <h4 class="card-title">Fecha del máximo de usuarios conectados</h4>
                <hr>
                <p class="card-text">
                  <?php echo date('d.m.Y', Yii::app()->counter->getMaximalTime()); ?>
                </p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>