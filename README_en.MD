<img src="https://app.sisocs.org/themes/blackboot/assets/img/logo_sisocs.png"></p>

# [SISOCS APP](https://app.sisocs.org/index.php?r=Ciudadano/index)

[Documentación en español](./README.md)

  - [Description and Context](#description-and-context)
  - [User Guide](#user-guide)
    - [Application Architecture](#application-architecture)
    - [Using the system](#using-the-system)
  - [Installation Guide](#instalation-guide)
    - [Installing the frontend application](#Installing-the-frontend-application)
    - [Installing the OCDS component](#Installing-the-OCDS-component)
      - [Adding information to the MongoDB schema](#adding-information-to-the-MongoDB-schema)
      - [config.json File for SISOCS module](#configjson-File-for-SISOCS-module)
      - [config.json File for server](#configjson-File-for-server)
      - [OCDS Json file](#ocds-json-file)
  - [How to Contribute](#how-to-contribute)
    - [Attributions](#attributions)
  - [Code of Conduct](#code-of-conduct)
    - [Our Pledge](#our-pledge)
    - [Our Standards](#our-standards)
    - [Our Responsibilities](#Our-Responsibilities)
    - [Scope](#scope)
    - [Enforcement](#enforcement)
    - [Attribution](#attribuition)
  - [Authors](#authors)
  - [Additional Information](#additional-information)
  - [License](#license)
  - [Limitation of responsibilities](#limitation-of-responsibilities)


## Description and Context

SISOCS PPP is a digital disclosure tool for Public Private Partnerships (PPPs). SISOCS PPP was developed by the Government of Honduras and the World Bank Group 
between 2017 and 2018. This system was designed following the disclosure framework for Honduras designed according to the recommendations from the 
[Disclosure Diagnostic Report](http://pubdocs.worldbank.org/en/773541448296707678/Disclosure-in-PPPs-Framework.pdf) in which 
[CoST Honduras](https://costhonduras.hn/) played an important role as partner in this project. This system is used by the 2 public entities in charge of 
identifying, screening, structuring, contracting, and overseeing PPPs in Honduras. The system complies with the WB Disclosure Framework, 
[The CoST Infrastructure Data Standard](https://infrastructuretransparency.org/resource/cost-infrastructure-data-standard/), and the [PPP Extension of the Open Contracting Data Standard (OCDS)](https://extensions.open-contracting.org/fr/extensions/ppp/master/).


### Application Architecture

<p align="center"><img src="https://infras-hn.org/images/Arquitectura%20SISCOS%20APP.png"></p>

### Using the system

#### Access
There are two ways to access the system, the first is by typing Sisocs App the search engine in your trusted browser, and the second way is by writing the address (app.sisocs.org) into the address bar located in the browser.

#### Homepage

#### A)	Menu Bar
The menu bar contains the following options:

<p align="center"><img src="https://infras-hn.org/images/sisocsapp/sisocsapp-menu.png"></p>

1. Home: this button allows you to go back to the introductory page of the website.
2. Projects Maps: Shows the geographical location where the infrastructure projects are located.
3. Reports: Includes two options, in the first one you can visualize or download in pdf the World Bank’s PPP Disclosure Diagnostic Report in Honduras. This report aims to help policy makers and PPP specialists to assess the state of PPP disclosure in the jurisdiction, and to identify customized solutions for all types of PPPs to enable a maximum disclosure of information on PPPs in Honduras. In the Second option you can download the data of all disclosed projects in XLS format.
4.	OCDS (Open Contracting Data Standard): This tab allows you to access the module to access the project data under the [Open Contracting Data Standard (OCDS).](https://standard.open-contracting.org/latest/en/)This standard enables disclosure of data and documents from all stages of the contracting process by defining a common data model.

<p align="center"><img src="https://infras-hn.org/images/sisocsapp/Sisocsapp-ocds.png"></p>

#### B) Project Section
This section shows a list of the projects published in the system and indicates the total number of projects disclosed and the total investment in Honduran lempiras and American dollars. It also presents a search bar which can be refined with different filters located on the left side of the project list. 

<p align="center"><img src="https://infras-hn.org/images/sisocsapp/Sisocsapp-proyectos.png"></p>

The next section following the list of projects presents two indicators constructed from the data entered into the system: 
a) The number of projects by infrastructure subsector, represented by a bar chart; 
b) The percentage of total progress according to project stage, represented by a pie chart.

<p align="center"><img src="https://infras-hn.org/images/sisocsapp/sisocsapp1.png"></p>

The last section of the home screen contains a summary of all projects and a section with announcements of the latest changes and news about published projects.

<p align="center"><img src="https://infras-hn.org/images/sisocsapp/sisocsapp2.png"></p>

#### Project search
This can be done in two ways:
* Through the search bar.
Once you find the project in the list, the next step is to select "VIEW DETAIL" to see all the project information found within the system.
* Through the map
The map function is to search for project information according to its location or, in the case of Honduras, by department.

If you wish to search other projects located in other departments you must make sure to delete in "active filters" the previously selected department, another option to remove the filter is to click on 'X' located next to the name of the  elected department.

<p align="left"><img src="https://infras-hn.org/images/sisocsapp/sisocsapp4.png" height="223" width="650"></p>

#### Detailed project information

The information is structured according to the stages of the PPP project cycle:
* Basic Project Information
* Contracting Process
* Financial Information
* Implementation
* Location
* Related Contracts

The page also has two additional sections that show the milestones or significant events that occur during the development of the project and a summary of the project.

<p align="left"><img src="https://infras-hn.org/images/sisocsapp/sisocsapp3.png"></p>


## Instalation Guide

SISOCS APP is a portal that contains data about Public Private Partnerships projects. Currently the application is running at the link: https://app.sisocs.org/

The [SISOCS - OCDS](https://app.sisocs.org/protected/ocdsShow/) component was built in NodeJS, in its LTS version to date (v8.9). This application server allows us to mount an API Server which is used by SISOCS - PHP to store the information of the projects in MongoDB. The projects can then be viewed in PPP format

SISOCS – PHP
[Source code (PHP-MySQL)](https://github.com/infrastructure-transparency/SISOCS-APP/tree/main/SISOCS%20FRONTEND)

### Installing the frontend application

##### Requirements:
* APACHE 2
* MySQL (Ver 14.14 Distrib 5.7.29, for Linux (x86_64) using  EditLine wrapper)

#### Setting-up:

Install it using the XAMPP package, which includes Apache and the MySQL database.

### Installing the OCDS component

The following programs and modules must be installed in order to prepare the development environment:

* Install Node JS.
* Install MongoDB.

Once all the previous dependencies are installed, you can proceed to execute the command to download the local SISOCS packages and their respective dependencies,
this is done through the command:

```
npm install
```
After successfully executing the command above, you are ready to start development.
To raise the api server use the command:

```
npm start
```
### Adding information to the MongoDB schema

In the folder “schema” you can find the schemas stored in MongoDB and then displayed in OCID PPP format.
Each schema refers to an OCID PPP object of the same name.

For more information about Mongoose schemas refer to:

* http://mongoosejs.com/docs/guide.html
* http://mongoosejs.com/docs/api.html#Schema

<img src="https://infras-hn.org/images/sisocsapp/Esquema1.png">
<img src="https://infras-hn.org/images/sisocsapp/Esquema2.png">

This element is filled in the file "data_retrieve.js" where there is a function for each schema.

<img src="https://infras-hn.org/images/sisocsapp/Esquema3.png">

The object returned by this function must comply with the Contract schema and is an arrangement of Contracts.
If a new element is added to the Contracts schema, it must also be added to this function so that it is stored correctly.

### config.json File for SISOCS module

* Metadata of the OCID PPP package to expose
* Extensions contains the extensions of the package.
* Ddocument_url is the url where the files stored in SISOCS are stored.
* preOCID is the general OCID you are working with.

### config.json File for server

```
DBCONFIG -> MONGO -> [APPTYPE] -> URL
Contains the URL in MongoDB format://USER:PASSWORD@IP/DB

DBCONFIG -> MYSQL -> [APPTYPE] -> [CONFIG] 
MySQL Configuration

DBType
Main database

HTTP
Contains HTTPS certificates if enabled

APPTYPE
What kind of Application (In what environment are we)

DEBUG
If it is enabled, more information will be obtained in the logs

ALLOWSIGNUP
Allows user registration to the application if necessary

FAKELOGIN
Bypass the login if it is enabled

LOGFILES
Location of log files

PORT
Exposure port

SESSIONTIMEOUT
Session time if enabled

USEHTTPS
Whether or not you want to expose in HTTPS
```
<img src="https://infras-hn.org/images/sisocsapp/config.png">

### OCDS Json file

The result of the Json in OCDS format of the application is the following:

* [JSON](https://infras-hn.org/images/sisocsapp/json_100121.json) - GENERATED 10/JAN/21

## How to contribute
Infrastructure Disclosure Platforms is CoST- [the Infrastructure Transparency Initiative](https://infrastructuretransparency.org)- effort aiming to support and guide members and partners to contribute, explore and reuse open-source digital tools published in our [CoST GitHub Repository](https://github.com/infrastructure-transparency). These tools can be used in the design and implementation of disclosure processes aiming to improve transparency and accountability in the infrastructure sector around the world.  

CoST believes that open-source codes developed by our members and partners should be publicly available to help us to contribute to delivering
quality infrastructure, strengthening economies, and improving lives. 

Therefore, CoST encourages those who contribute to the improvement of these digital tools, to share them with us. If when reusing this digital tool, 
you consider that you:
* have added some new functionality with which you add value for more people to reuse,
* have made the tool more versatile to support new updates,
* have fixed some existing bugs,
* or you have simply improved the user interface or documentation of it

We encourage you to return the progress made to the repository. Follow these steps to contribute to the digital tool:
1.	Fork the repository.
2.	Develop the new functionality or make the changes you create that add value to the tool.
3.	Make a "pull request" documenting in detail the proposed changes in the repository.
4.	In such case, your name will be registered in the list of attributions.

If you have not contributed to the repository, but the tool has been helpful to you, we would love to hear about your experience. Tell us about it in an Issue or via email to opencode@infrastructuretransparency.org.

### Attributions
Tell us in the "pull request" your username and organization to add it to the list of contributions in the Readme.md. files.

## Code of Conduct

### Our Pledge
In the interest of fostering an open and welcoming environment, we as contributors and maintainers pledge to making participation in our portal and our community a harassment-free experience for everyone, regardless of age, body size, disability, ethnicity, gender identity and expression, level of experience, nationality, personal appearance, race, religion, or sexual identity and orientation.

### Our Standards
Examples of behaviour that contributes to creating a positive environment include:
* Using welcoming and inclusive language
* Being respectful of differing viewpoints and experiences
* Gracefully accepting constructive criticism
* Focusing on what is best for the community.
* Showing empathy towards other community members

Examples of unacceptable behaviour by participants include:
* The use of sexualized language or imagery and unwelcome sexual attention or advances
* Trolling, insulting/derogatory comments, and personal or political attacks.
* Public or private harassment
* Publishing others' private information, such as a physical or electronic address, without explicit permission
* Other conduct which could reasonably be considered inappropriate in a professional setting.

### Our Responsibilities
Project maintainers and contributors are responsible for clarifying the standards of acceptable behaviour and are expected to take appropriate and fair corrective action in response to any instances of unacceptable behaviour.
The Infrastructure Transparency Platform maintainers have the right and responsibility to remove, edit, or reject comments, commits, code, wiki edits, issues, and other contributions that are not aligned to this Code of Conduct, or to ban temporarily or permanently any contributor for other behaviours that they deem inappropriate, threatening, offensive, or harmful.

### Scope
This Code of Conduct applies within the Infrastructure Disclosure Platform repository and in public spaces when an individual is representing CoST or its community. Examples CoST representation include using an official CoST e-mail address, posting via an official social media account, or acting as an appointed representative at an online or offline event. CoST representation may be further defined and clarified by the Infrastructure Disclosure Platform maintainers.

### Enforcement
Instances of abusive, harassing, or otherwise unacceptable behaviour may be reported by contacting this repository's maintainer or at opencode@infrastructuretransparency.org
All complaints will be reviewed and investigated and will result in a response that is deemed necessary and appropriate to the circumstances. The CoST team is obligated to maintain confidentiality regarding the reporter of an incident.
The Infrastructure Transparency Platform maintainers who do not follow or enforce the Code of Conduct may face temporary or permanent repercussions as determined by CoST.

### Attribution
This Code of Conduct is adapted from the [Contributor Covenant](https://www.contributor-covenant.org/), version 1.4, available at http://contributor-covenant.org/version/1/4.

## Authors
 
The Government of Honduras and the World Bank Group are the original authors of the [SISOCS PPP](https://app.sisocs.org/index.php?r=Ciudadano/index). 

## Additional Information
 
* [About CoST Honduras](https://infrastructuretransparency.org/where-we-work/cost-honduras/)
* [The PPP Disclosure Diagnostic Report](http://pubdocs.worldbank.org/en/773541448296707678/Disclosure-in-PPPs-Framework.pdf)
* [CoST tools and standards](https://infrastructuretransparency.org/cost-tools-and-standards/#SISOCS-APP)

## License
 
GNU GPLv3
Permissions of this strong copyleft license are conditioned on making available complete source code of licensed works and modifications, which include larger works using a licensed work, under the same license. Copyright and license notices must be preserved. Contributors provide an express grant of patent rights.

## Limitation of responsibilities
 
CoST is not responsible, under any circumstance, for damage or compensation, moral or patrimonial; direct or indirect; accessory or special; or by way of consequence, foreseen or unforeseen, that could arise:
- Under any concept of intellectual property, negligence, or detriment of another part theory. 
- Following the use of this Digital Tool, including, but not limited to defects in the Digital Tool, or the loss or inaccuracy of data of any kind. The foregoing includes expenses or damages associated with communication failures and / or malfunctions of computers, linked to the use of this Digital Tool.
