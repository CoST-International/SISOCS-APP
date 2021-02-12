<img src="https://app.sisocs.org/themes/blackboot/assets/img/logo_sisocs.png"></p>

# [SISOCS APP - OCDS](https://app.sisocs.org/index.php?r=Ciudadano/index)

[English documentation](README_en.MD)

- [Descripción y contexto](#descripción-y-contexto)
  - [Guía del usuario](#guía-del-usuario)
    - [Arquitectura](#arquitectura)
    - [Uso del sistema](#uso-del-sistema)
  - [Guía de instalación](#Guía-de-instalación)
    - [Instalación del frontend](#instalación-del-frontend)
    - [Instalación del componenete OCDS](#Instalación-del-componenete-OCDS)
       - [Agregar información al esquema de MongoDB](#Agregar-información-al-esquema-de-MongoDB)
       - [Archivo config.json para el módulo SISOCS](#Archivo-configjson-para-el-módulo-SISOCS)
       - [Archivo config.json para el servidor](#Archivo-configjson-para-el-servidor)
  - [Cómo contribuir](#Cómo-contribuir)
    - [Atribuciones](#atribuciones)
  - [Código de conducta](#código-de-conducta)
    - [Nuestro compromiso](#our-pledge)
    - [Nuestras normas](#nuestras-normas)
    - [Nuestras responsabilidades](#nuestras-responsabilidades)
    - [Ámbito de aplicación](#ámbito-de-aplicación)
    - [Aplicación de este código](#aplicación-de-este-código)
    - [Atribución](#atribución)
  - [Autores](#autores)
  - [Información adicional](#información-adicional)
  - [Licencia](#licencia)
  - [Limitación de responsabilidades](#Limitación-de-responsabilidades)


## Descripción y contexto

SISOCS APP es una herramienta de divulgación digital para las Asociaciones Público Privadas (APP). SISOCS APP fue desarrollado por el Gobierno de Honduras y el Grupo del Banco Mundial entre 2017 y 2018. Este sistema fue diseñado siguiendo el marco de divulgación recomendado para Honduras, basado en las recomendaciones del [Informe de Diagnóstico de Divulgación](https://costhonduras.hn/wp-content/uploads/2018/12/diagnostico_divulgacion.pdf) en el que [CoST Honduras](https://costhonduras.hn/) jugó un papel importante como socio en este proyecto. Este sistema es utilizado por las 2 entidades públicas encargadas de identificar, seleccionar, estructurar, contratar y supervisar las APP en Honduras. El sistema cumple con el Marco de Divulgación del Banco Mundial, el [Estándar de Datos de Infraestructura de CoST](https://infrastructuretransparency.org/resource/cost-infrastructure-data-standard/) y la [Extensión del Estándar de Datos de Contrataciones Abiertas para el perfil de Asociaciones Público Privadas](https://extensions.open-contracting.org/es/extensions/ppp/master/).

## Guía del usuario
SISOCS APP es un portal que permite conocer acerca de los proyectos de las Alianzas Público Privadas. Actualmente el aplicativo se encuentra ejecutando en el link: https://app.sisocs.org/

El componenete [SISOCS – OCDS](https://app.sisocs.org/protected/ocdsShow/) fue construido en NodeJS, en su versión LTS a la fecha (v8.9). 
Dicho servidor de aplicaciones nos permite montar un API Server el cual es usado por SISOCS – PHP para almacenar la información de los proyectos en MongoDB. 

SISOCS – PHP
[Código Fuente PHP-MySQL](https://github.com/infrastructure-transparency/SISOCS-APP/tree/main/SISOCS%20FRONTEND)

### Arquitectura 

<p align="center"><img src="https://infras-hn.org/images/Arquitectura%20SISCOS%20APP.png"></p>

### Uso del sistema

#### Acceso
Existen dos formas para ingresar al sistema, en la primera debe de buscar en su navegador de confianza SISOCS APP y la segunda forma consiste en ingresar por medio de un enlace (www.app.sisocs.org) que lo llevará automáticamente al sitio.

#### Página de inicio

#### A) Barra de menú

La barra de menú contiene las siguientes opciones:

<p align="center"><img src="https://infras-hn.org/images/sisocsapp/sisocsapp-menu.png"></p>

1.	Inicio: Permite que el usuario pueda regresar a la pantalla inicial del sistema.
2.	Mapas del proyecto: Muestra la ubicación geográfica donde se están desarrollando los proyectos de infraestructura.
3.	Informes: Incluye dos opciones, en la primera podrá visualizar o descargar en pdf el “Informe de diagnóstico de divulgación: Honduras” , este informe tiene el objetivo de ayudar a los formuladores de políticas y a los profesionales de las APP a evaluar el estado de la divulgación de la APP en la jurisdicción, y a identificar soluciones personalizadas para todos los tipos de APP con el fin de permitir mayor divulgación de información sobre las APP. En la Segunda opción puede descargar los datos de todos los proyectos divulgados en formato XLS.
4.	OCDS (Open Contracting Data Standard): Esta pestaña permite visualizar el módulo donde se encuentran los datos de los proyectos bajo el Estándar de Datos para las Contrataciones Abiertas (OCDS). Este estándar permite la divulgación de datos y documentos de todas las etapas del proceso de contratación mediante la definición de un modelo de datos común 

<p align="center"><img src="https://infras-hn.org/images/sisocsapp/Sisocsapp-ocds.png"></p>

#### B) Sección Proyectos 
Esta sección muestra una lista de los proyectos publicados en el sistema e indica el número total de proyetos divulgados y la inversión total en lempiras y en dólares americanos. Además presenta opciones de búsqueda de proyectos a través una barra de búsqueda la cual se puede refinar con diferentes filtros ubicados al lado izquierdo de la lista de proyectos. 

<p align="center"><img src="https://infras-hn.org/images/sisocsapp/Sisocsapp-proyectos.png"></p>

Seguido de la lista de proyectos se presentan dos gráficos que miden dos indicadores construidos a partir de la data ingresada en el sistema:
a.	La cantidad de proyectos según el subsector de infraestructura, representado con un gráfico de barras.  
b.	El porcentaje de avance total según la etapa del proyecto, representado por un gráfico de pastel.

<p align="center"><img src="https://infras-hn.org/images/sisocsapp/sisocsapp1.png"></p>

La última sección de la pantalla de inicio presenta un resumen de todos los proyectos y un apartado con los anuncios de los últimos cambios y noticias sobre los proyectos publicados. 

<p align="center"><img src="https://infras-hn.org/images/sisocsapp/sisocsapp2.png"></p>


#### Busqueda de proyectos

Puede realizarse a través de dos formas: 

* A través de la barra de búsqueda 

Una vez que encuentra el proyecto en la lista, el siguiente paso es seleccionar “VER DETALLE” para ver toda la información del proyecto que se encuentra dentro del sistema.

* A través del mapa

La función del mapa es de buscar la información de los proyectos de acuerdo con su zona geográfica o, en el caso de Honduras, por departamento.
Pasos: 
  1.	Seleccionar el departamento donde se desarrolla el proyecto de interés
  2.	Buscar en la lista el proyecto de interés para ver a detalle 
  3. Si desea buscar en más departamentos debe asegurarse de eliminar en “filtros activos” el departamento seleccionado anteriormente, otra opción es hacer clic encima del departamento seleccionado anteriormente.
  
  <p align="left"><img src="https://infras-hn.org/images/sisocsapp/sisocsapp4.png" height="223" width="650"></p>

#### Información detallada de los proyectos

La información está estructurada de acuerdo a las etapas del ciclo de los proyectos APP: 
* Información Básica del Proyecto
* Proceso de Contratación
* Información Financiera
* Implementación
* Ubicacióm
* Contratos relacionados 
    
Además, tiene dos apartados adicionales donde se muestra los Hitos o acontecimientos significativos que suceden durante el desarrollo del proyecto y un resumen del proyecto. 

<p align="left"><img src="https://infras-hn.org/images/sisocsapp/sisocsapp3.png"></p>

## Guía de instalación

### Instalación del frontend

##### Requerimientos:
* APACHE 2
* MySQL (Ver 14.14 Distrib 5.7.29, for Linux (x86_64) using  EditLine wrapper)

#### Indicaciones:

Instalarlo mediante el paquete XAMPP, que incluye Apache y la base de datos MySQL.

### Instalación del componenete OCDS

Se debe proceder a instalar los siguientes programas y módulos con el fin de preparar el ambiente de desarrollo:

* Instalar Node JS.
* Instalar MongoDB.

Con todas las dependencias anteriores instaladas se puede proceder a ejecutar el comando para descargar los paquetes locales de SISOCS y sus respectivas dependencias, 
esto se hace a través del comando:

```
npm install
```

Después de ejecutar exitosamente el comando anterior, se estará listo para iniciar el desarrollo. 
Para levantar el api server utilizar el comando: 

```
npm start
```
#### Agregar información al esquema de MongoDB 

En la carpeta “schema” se encuentran los esquemas que se almacenan en MongoDB y luego son
mostrados en formato OCID PPP.
Cada esquema hace referencia a un objeto OCID PPP del mismo nombre. 

Para más información acerca de los esquemas de Mongoose referirse a:

* http://mongoosejs.com/docs/guide.html
* http://mongoosejs.com/docs/api.html#Schema

<img src="https://infras-hn.org/images/sisocsapp/Esquema1.png">
<img src="https://infras-hn.org/images/sisocsapp/Esquema2.png">

Este elemento se llena en el archivo “data_retrieve.js” donde existe una función por cada schema.

<img src="https://infras-hn.org/images/sisocsapp/Esquema3.png">

El objeto que retorne esta función debe de cumplir con el esquema de Contract y es un arreglo de
Contracts.
Si se agrega un nuevo elemento al esquema de Contracts también deberá de agregarse a esta función para que se almacena de manera correcta.

#### Archivo config.json para el módulo SISOCS

* Metadata del package OCID PPP a exponer
* Extensions contiene las extensiones del package.
* Ddocument_url es la URL donde se almacenan los archivos almacenados en SISOCS.
* preOCID es el OCID general con el que se está trabajando.

<img src="https://infras-hn.org/images/sisocsapp/config.png">

#### Archivo config.json para el servidor
```
DBCONFIG -> MONGO -> [APPTYPE] -> URL
Contiene la URL en formato MongoDB://USER:PASSWORD@IP/DB

DBCONFIG -> MYSQL -> [APPTYPE] -> [CONFIG] 
Configuración de MySQL

DBType
Base de datos principal

HTTP
Contiene certificados de HTTPS en caso de estar habilitado

APPTYPE
Que clase de Aplicación (En qué ambiente estamos)

DEBUG
Si está habilitado se obtendrá más información en los logs

ALLOWSIGNUP
Permite el registro de usuarios a la app en caso de ser necesario

FAKELOGIN
Hace un bypass al login en caso de estar habilitado

LOGFILES
Localización de los archivos de log

PORT
Puerto de exposición

SESSIONTIMEOUT
Tiempo de sesión en caso de estar habilitado

USEHTTPS
Si se desea o no exponer en HTTPS
```
<img src="https://infras-hn.org/images/sisocsapp/config.png">

#### Archivo Json del OCDS 

El resultado del Json en formato OCDS del aplicativo es el siguiente:

* [JSON](https://infras-hn.org/images/sisocsapp/json_100121.json) - GENERADO 10/01/21

## Cómo contribuir

La plataforma de divulgación para datos de infraestructura es el portal de [CoST -la Iniciativa de Transparencia en Infraestructura](https://infrastructuretransparency.org/https://infrastructuretransparency.org/)- en GitHub que permite explorar y reutilizar herramientas digitales de código abierto que pueden utilizarse en el diseño y la implementación de nuestra ruta de divulgación, con el objetivo de mejorar la transparencia y la responsabilidad en el sector de infraestructura en todo el mundo.  

Creemos que los códigos fuentes abiertos desarrollados por nuestros miembros y socios deben estar a disposición del público para ayudarnos a contribuir a proporcionar infraestructuras de calidad, fortalecer las economías y mejorar vidas. 
Por ello, animamos a quienes contribuyen a la mejora de estas herramientas digitales a que compartan sus aportes con nosotros. 

Si al reutilizar esta herramienta digital, consideras que
* Has añadido alguna funcionalidad nueva con la que aportas valor para que más personas la reutilicen,
* Has hecho la herramienta más versátil para respaldar nuevas actualizaciones,
* Has corregido algunos errores existentes,
* O simplemente has mejorado la interfaz de usuario o la documentación de la misma.
Te animamos a que devuelvas los progresos realizados al repositorio. Sigue estos pasos para contribuir a la herramienta:

1.	Haz una división del repositorio. 
2.	Desarrolla la nueva funcionalidad o realiza los cambios que crees que añaden valor a la herramienta.
3.	Haz una “solicitud de eliminar” documentando en detalle los cambios propuestos en el repositorio.
4.	En ese caso, tu nombre quedará registrado en la lista de atribuciones.

Si no has contribuido al repositorio, pero la herramienta te ha resultado útil, nos encantaría conocer tu experiencia. Cuéntanos tu experiencia en un “Issue” o por correo electrónico a opencode@infrastructuretransparency.org


### Atribuciones
Al enviar una solicitud de adhesión de nuevo código (“pull requests”), puedes compartirnos tu nombre de usuario y organización para añadirlo a la lista de contribuciones en el Readme.md.

## Código de conducta

### Nuestro compromiso
En aras de fomentar un entorno abierto y amigable, nosotros, como equipo de colaboradores y a cargo del mantenimiento de este repositorio, nos comprometemos a hacer de la participación en nuestro portal y en nuestra comunidad una experiencia libre de acoso para todos, independientemente de la edad, discapacidad, nacionalidad, origen étnico, nivel de experiencia, apariencia personal, raza, religión, identidad, género y/o orientación sexual. 

### Nuestras normas
Algunos ejemplos de comportamientos que contribuyen a crear un entorno positivo son:
* Utilizar un lenguaje de bienvenida e inclusivo.
* Ser respetuoso con los diferentes puntos de vista y experiencias.
* Aceptar con gentileza las críticas constructivas.
* Centrarse en lo que es mejor para la comunidad.
* Mostrar empatía hacia otros miembros de la comunidad.

Ejemplos de comportamiento inaceptable por parte de los participantes son:
* El uso de lenguaje o imágenes sexualizadas, atenciones e insinuaciones sexuales no deseadas.
*	Ofensas, comentarios insultantes/despectivos y ataques personales o políticos.
*	Acoso público o privado.
*	Publicar información privada de otros, como una dirección física o electrónica, sin permiso explícito.
*	Otras conductas que puedan considerarse razonablemente inapropiadas en un entorno profesional.

### Nuestras responsabilidades

Los que dan mantenimiento y colaboradores del proyecto son responsables de aclarar las normas de comportamiento aceptable y se espera que tomen medidas correctivas adecuadas y justas en respuesta a cualquier caso de comportamiento inaceptable.
Los responsables del mantenimiento de las Plataformas de Divulgación de datos sobre Infraestructura, tienen el derecho y la responsabilidad de eliminar, editar o rechazar comentarios, confirmaciones, códigos, ediciones wiki, cuestiones y otras contribuciones que no se ajusten a este Código de Conducta, o prohibir temporal o permanentemente a cualquier colaborador por otros comportamientos que consideren inapropiados, amenazantes, ofensivos o perjudiciales.

### Ámbito de aplicación

Este Código de Conducta se aplica tanto en los espacios de la Plataforma de Transparencia en Infraestructura como en los espacios públicos cuando una persona representa a CoST o a su comunidad. Ejemplos de representación de CoST o de la comunidad incluyen el uso de una dirección de correo electrónico oficial, la publicación a través de una cuenta oficial en las redes sociales o la actuación como representante designado en un evento en línea o fuera de línea. La representación de un CoST puede ser definida y aclarada por los responsables de la Plataforma de Transparencia en Infraestructura.

### Aplicación de este código

Los casos de comportamiento abusivo, acosador o inaceptable pueden denunciarse poniéndose en contacto con el responsable de este repositorio o en opencode@infrastructuretransparency.org.
Todas las denuncias serán revisadas e investigadas y darán lugar a una respuesta que se considere necesaria y adecuada a las circunstancias. El equipo de CoST está obligado a mantener la confidencialidad sobre el denunciante de un incidente.
Los encargados del mantenimiento de las Plataformas de Divulgación de datos sobre Infraestructura que no sigan o hagan cumplir el Código de Conducta pueden enfrentarse a repercusiones temporales o permanentes según lo determine CoST.

### Atribución

Este Código de Conducta es una adaptación del [Pacto de Colaboradores](https://www.contributor-covenant.org/), versión 1.4, disponible en http://contributor-covenant.org/version/1/4.


## Autores
El Gobierno de Honduras y el Grupo del Banco Mundial son los autores originales del [SISOCS APP](https://app.sisocs.org/index.php?r=Ciudadano/index).

## Información adicional

* [Acerca de CoST Honduras](https://infrastructuretransparency.org/where-we-work/cost-honduras/)
* [Informe de diagnóstico de divulgación de las APP](http://pubdocs.worldbank.org/en/773541448296707678/Disclosure-in-PPPs-Framework.pdf)
* [Herramientas y estándares de CoST](https://infrastructuretransparency.org/cost-tools-and-standards/#SISOCS-APP)

## Licencia
GNU GPLv3
Los permisos de esta licencia copyleft están condicionados a poner a disposición el código fuente completo de los trabajos con licencia y las modificaciones, que incluyen trabajos mayores que utilizan una obra con licencia, bajo la misma licencia. Las notificaciones de derechos de autor y de licencia deben conservarse. Los colaboradores proporcionan una concesión expresa de derechos de patente.

## Limitación de responsabilidades
CoST no se hace responsable, bajo ninguna circunstancia, de los daños e indemnizaciones, morales o patrimoniales; directos o indirectos; secundarios o especiales; o por vía de consecuencia prevista o imprevista que pudieran surgir:

* Bajo ningún concepto de propiedad intelectual, negligencia o en detrimento de otra parte de la teoría.
* Como consecuencia del uso de esta herramienta digital, incluyendo, pero sin limitarse a los defectos de la herramienta digital, o la pérdida o inexactitud de datos de cualquier tipo. Lo anterior incluye los gastos o daños asociados a fallas de comunicación y/o mal funcionamiento de los ordenadores vinculados al uso de esta herramienta digital.

