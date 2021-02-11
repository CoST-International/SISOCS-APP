function sizeObject (obj) {
    var count = 0;

    for (var property in obj) {
        if (Object.prototype.hasOwnProperty.call(obj, property)) {
            count++;
        }
    }

    return count;
}
function basicProject(dataDocs){
    ArrayBasicProject= [];
    if (sizeObject(dataDocs)>0) {
        ArrayBasicProject.push(
            ['\n\nSector: \n '+dataDocs['proyecto_sector']+'\n\n','\n\nSub Sector: \n '+dataDocs['proyecto_subsector']+'\n\n'],
            ['\n\nDepartamento: \n '+dataDocs['departamento']+'\n\n','\n\nMunicipio: \n '+dataDocs['municipio']+'\n\n'],
            ['\n\nFecha de Aprobación: \n '+dataDocs['fechaaprob']+'\n\n','\n\nPresupuesto: \n '+Intl.NumberFormat().format(dataDocs['presupuesto'], 2) +'\n\n'],
        )
    }
    return ArrayBasicProject;
}
function basicProject2(dataDocs){
    ArrayBasicProject=[];

    if(sizeObject(dataDocs)>0){
        ArrayBasicProject.push(
            { text: "\nNombre del Proyecto", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+dataDocs['nombre_proyecto']+"\n\n", style: 'contenido' },

            { text: "\nProposito", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n"+dataDocs['idProposito']+"\n\n", style: 'contenido' },

            { text: "\nDescripción", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n"+dataDocs['descrip']+"\n\n", style: 'contenido',  },
        )
    }
    return ArrayBasicProject;

}
function basicProject3(dataDocs){
    ArrayBasicProject= [];
    if (sizeObject(dataDocs)>0) {
        ArrayBasicProject.push(
            [{ text: "\nNOMBRE", style:'contenido2'},{ text: "\nPUESTO", style:'contenido2'},{ text: "\nCORREO", style:'contenido2'},{ text: "\nTELEFONO", style:'contenido2'},{ text: "\nAUTORIDAD PÚBLICA(PATROCINADOR)", style:'contenido2'}],
            [dataDocs['funcionario_nombre'],dataDocs['funcionario_correo'],dataDocs['funcionario_puesto'],dataDocs['funcionario_telefono'],dataDocs['entes_nombre']],
        )

    }
    return ArrayBasicProject;
}
function printBasicProject(dataDocs){
    ArrayBasicProjectPrint=[];
    if(sizeObject(dataDocs)>0){
        ArrayBasicProjectPrint.push(
            {text: '\n\n\nPlanificación del Proyecto\n\n', style:'titulo'},
            {

                table:{

                    widths: ['50%', '50%'],
                    body:basicProject(dataDocs),
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        );
    }
    return ArrayBasicProjectPrint;

}
function printPreCalificacion(dataDocs){
    ArrayPrecalificacionPrint = [];
    if (sizeObject(dataDocs)>0) {

        ArrayPrecalificacionPrint.push(
            {text: '\n\n\nProceso de contratación\n\n', style:'titulo'},
            { text: "\nPre-Calificación", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['33%', '33%','33%'],
                    body:precalificacionToPdf(dataDocs)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayPrecalificacionPrint;
}
function printDatosFuncionarioProject(dataDocs){
    ArrayDatosFuncionariosPrint=[];
    if (sizeObject(dataDocs)>0) {
        ArrayDatosFuncionariosPrint.push(
            { text: "\nDatos del Funcionario", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n", },
            {

                table:{
                    body:basicProject3(dataDocs),
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayDatosFuncionariosPrint;
}
function printPronostico(data){
    ArrayPronosticoPrint=[]
    if (sizeObject(data)>0) {
        ArrayPronosticoPrint.push(
            { text: "\nPronostico", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['25%', '25%','25%','25%'],
                    body:pronosticoToPdf(data),
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )

    }
    return ArrayPronosticoPrint;
}
function printHitos(data){
    ArrayHitosPrint=[];
    if (sizeObject(data)>0) {
        ArrayHitosPrint.push(
            { text: "\nHitos de la planificación", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['33%', '33%','33%'],
                    body:pHitosToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayHitosPrint;
}
function printProjectDocs(data){
    ArrayProjectDocs = [];
    if (sizeObject(data)>0) {
        ArrayProjectDocs.push(
            { text: "\nDocumentos", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n" },
            {

                table:{

                    widths: ['50%', '50%'],
                    body:docsToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayProjectDocs;
}
function printPresupuesto(data){
    ArrayBudgetPrint=[];
    if (sizeObject(data)>0) {
        ArrayBudgetPrint.push(
            { text: "\nDesglose del presupuesto", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['25%', '25%','25%','25%'],
                    body:budgetToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        );
    }
    return ArrayBudgetPrint;
}
function printFuentesFinanciamiento(data){
    var ArrayFuentesPrint = [];
    if (sizeObject(data)>0) {
        ArrayFuentesPrint.push(
            { text: "\nFuentes de financiamiento", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['60%', '20%','10%','10%'],
                    body:fuentesToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayFuentesPrint;
}
function printBeneficiarios(data){
    ArrayBeneficiarioPrint=[];
    if (sizeObject(data)>0) {
        ArrayBeneficiarioPrint.push(
            { text: "\nBeneficiarios", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['14%', '14%','72%'],
                    body:beneficiariosToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayBeneficiarioPrint;
}

function basicCalificacion(dataDocs){
    ArrayBasicCalificacion= [];
    if (sizeObject(dataDocs)>0) {
        ArrayBasicCalificacion.push(
            {text: '\n\n\nInvitación y Cálificación\n\n', style:'titulo'},

            { text: "\nNúmero del proceso", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+dataDocs[0]['numproceso']+"\n\n", style: 'contenido' },

            { text: "\nNombre", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n"+dataDocs[0]['nomprocesoproyecto']+"\n\n", style: 'contenido' },

            { text: "\nMétodo de adquisiciones", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n"+dataDocs[0]['metodo_adquisicion']+"\n\n", style: 'contenido',  },

            { text: "\nNúmero de empresas participantes", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n"+dataDocs.length+"\n\n", style: 'contenido',  },

            { text: "\nFecha de publicación", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n"+dataDocs[0]['fecha_publicacion']+"\n\n", style: 'contenido',  },

            { text: "\nTipo de contrato", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n"+dataDocs[0]['tipo_contrato']+"\n\n", style: 'contenido',  },

            /*{ text: "\nDatos del Funcionario", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n", },
            {

                table:{
                    widths: ['20%', '20%','20%','20%','20%'],
                    body:[
                        [{ text: "\nNOMBRE", style:'contenido2'},{ text: "\nPUESTO", style:'contenido2'},{ text: "\nCORREO", style:'contenido2'},{ text: "\nTELEFONO", style:'contenido2'},{ text: "\nAUTORIDAD PÚBLICA(PATROCINADOR)", style:'contenido2'}],
                        [dataDocs[0]['funcionario_nombre'],dataDocs[0]['funcionario_puesto'],dataDocs[0]['funcionario_correo'],dataDocs[0]['funcionario_telefono'],dataDocs[0]['entes_nombre']],
                    ],
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },*/
        )
    }
    return ArrayBasicCalificacion;
}
function printFuncionarioCalificacion(dataDocs){
    ArrayBasicCalificacion= [];
    if (sizeObject(dataDocs)>0) {
        ArrayBasicCalificacion.push(

            { text: "\nDatos del Funcionario", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n", },
            {

                table:{
                    widths: ['20%', '20%','20%','20%','20%'],
                    body:[
                        [{ text: "\nNOMBRE", style:'contenido2'},{ text: "\nPUESTO", style:'contenido2'},{ text: "\nCORREO", style:'contenido2'},{ text: "\nTELEFONO", style:'contenido2'},{ text: "\nAUTORIDAD PÚBLICA(PATROCINADOR)", style:'contenido2'}],
                        [dataDocs[0]['funcionario_nombre'],dataDocs[0]['funcionario_puesto'],dataDocs[0]['funcionario_correo'],dataDocs[0]['funcionario_telefono'],dataDocs[0]['entes_nombre']],
                    ],
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayBasicCalificacion;
}
function printOferentesParticipantes(data){
    ArrayOferentesPrint=[];
    if (sizeObject(data)>0) {
        ArrayOferentesPrint.push(
            { text: "\nOferentes Participantes", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n", },
            {

                table:{
                    widths: ['10%', '90%'],
                    body:oferentesToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        );
    }
    return ArrayOferentesPrint;
}
function printDocsCalificacion(data){
    ArrayCDocsPrint=[];
    if (sizeObject(data)>0) {
        ArrayCDocsPrint.push(
            { text: "\nDocumentos", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['50%', '50%'],
                    body:CalificacionDocsToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        );
    }
    return ArrayCDocsPrint;
}

function basicAdjudicacion(data){
    ArrayBasicAdjudicacion= [];
    if (sizeObject(data)>0) {
        ArrayBasicAdjudicacion.push(
            {text: '\n\n\nAdjudicación\n\n', style:'titulo'},

            { text: "\nNúmero de adjudicación", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+data[0]['numproceso']+"\n\n", style: 'contenido' },

            { text: "\nCosto estimado", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+Intl.NumberFormat().format(data[0]['costoesti'], 2)+"\n\n", style: 'contenido' },

            { text: "\nMetodo de la adjudicación", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+data[0]['nombre']+"\n\n", style: 'contenido' },

            { text: "\nFecha publicación", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+data[0]['fecha_publicacion']+"\n\n", style: 'contenido' },
        )
    }
    return ArrayBasicAdjudicacion;
}
function printDocsAdjudicacion(data){
    ArrayADocsPrint=[];
    if (sizeObject(data)>0) {
        ArrayADocsPrint.push(
            { text: "\nDocumentos", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n" },
            {

                table:{

                    widths: ['50%', '50%'],
                    body:AdjudicacionDocsToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        );
    }
    return ArrayADocsPrint;
}
function printOferentesPreferidos(data){
    ArrayOferentesPreferidosPrint=[];
    if (sizeObject(data)>0) {
        ArrayOferentesPreferidosPrint.push(
            { text: "\nOferentes Preferidos", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            {

                table:{

                    widths: ['100%'],
                    body:AdjudicacionOferentesPreferidosToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        );
    }
    return ArrayOferentesPreferidosPrint;
}

function basicContratacion(data){
    ArrayBasicContratacion= [];
    if (sizeObject(data)>0) {
        ArrayBasicContratacion.push(
            {text: '\n\n\nResumen del Contrato\n\n', style:'titulo'},
            { text: "\nNúmero de contratación", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+data[0]['ncontrato']+"\n\n", style: 'contenido' },

            { text: "\nNombre del contrato", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+data[0]['titulocontrato']+"\n\n", style: 'contenido' },

            { text: "\nEmpresa", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+data[0]['legalName']+"\n\n", style: 'contenido' },

            { text: "\nAlcance", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+data[0]['alcances']+"\n\n", style: 'contenido' },

            { text: "\nFecha de inicio", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+data[0]['fechainicio']+"\n\n", style: 'contenido' },

            { text: "\nFecha final", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+data[0]['fechafinal']+"\n\n", style: 'contenido' },

            { text: "\nCosto en lempiras", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+Intl.NumberFormat().format(data[0]['precioLPS'], 2)+"\n\n", style: 'contenido' },

            { text: "\nCosto equivalente doláres", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+Intl.NumberFormat().format(data[0]['precioUSD'], 2)+"\n\n", style: 'contenido' },

            { text: "\nFecha de publicación", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd", }]},
            { text: "\n"+data[0]['fecha_publicacion']+"\n\n", style: 'contenido' },
        )
    }
    return ArrayBasicContratacion;
}
function printFirmantes(data){
    ArrayFirmantesPrint= [];
    if (sizeObject(data)>0) {
        ArrayFirmantesPrint.push(
            { text: "\nFirmantes", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n" },
            {

                table:{

                    widths: ['100%'],
                    body:ContratacionFirmantesToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayFirmantesPrint;
}
function printDetallesOrganizacion(data){
    ArrayDetallesOrganizacionPrint= [];
    if (sizeObject(data)>0) {
        ArrayDetallesOrganizacionPrint.push(
            { text: "\nDetalles de Organización ", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['100%'],
                    body:ContratacionOrganizacionToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayDetallesOrganizacionPrint;
}
function printAccionista(data){
    ArrayAccionistaPrint= [];
    if (sizeObject(data)>0) {
        ArrayAccionistaPrint.push(
            { text: "\nAccionista ", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['25%','25%','25%','25%'],
                    body:ContratacionAccionistaToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayAccionistaPrint;
}
function printPrestamista(data){
    ArrayPrestamistaPrint= [];
    if (sizeObject(data)>0) {
        ArrayPrestamistaPrint.push(
            { text: "\nPrestamista ", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['25%','25%','25%','25%'],
                    body:ContratacionAccionistaToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayPrestamistaPrint;
}
function printGarantiaGovierno(data){
    ArrayGarantiaGoviernoPrint= [];
    if (sizeObject(data)>0) {
        ArrayGarantiaGoviernoPrint.push(
            { text: "\nGarantia de govierno ", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['25%','10%','15%','15%', '20%', '15%'],
                    body:ContratacionGovGarantiaToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayGarantiaGoviernoPrint;
}
function printRiesgos(data){
    ArrayRiesgosPrint= [];
    if (sizeObject(data)>0) {
        ArrayRiesgosPrint.push(
            { text: "\nRiesgos ", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['50%','50%'],
                    body:ContratacionRiskToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayRiesgosPrint;
}
function printRatio(data){
    ArrayRatioPrint= [];
    if (sizeObject(data)>0) {
        ArrayRatioPrint.push(
            { text: "\nRatio del capital de la deuda ", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['20%','20%','20%','20%','20%'],
                    body:ContratacionRatioToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayRatioPrint;
}
function printTir(data){
    ArrayTirPrint= [];
    if (sizeObject(data)>0) {
        ArrayTirPrint.push(
            { text: "\nTIR ", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n" },
            {

                table:{

                    widths: ['33%','33%','33%'],
                    body:ContratacionIrrToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayTirPrint;
}
function printCapitalCompartido(data){
    ArrayCapitalCompartidoPrint= [];
    if (sizeObject(data)>0) {
        ArrayCapitalCompartidoPrint.push(
            { text: "\nCapital Compartido ", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n" },
            {

                table:{

                    widths: ['33%','33%','33%'],
                    body:ContratacionShareCapitalToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayCapitalCompartidoPrint;
}
function printEnmiendas(data){
    ArrayEnmiendasPrint= [];
    if (sizeObject(data)>0) {
        ArrayEnmiendasPrint.push(
            { text: "\nEnmiendas ", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
            { text: "\n" },
            {

                table:{

                    widths: ['33%','33%','33%'],
                    body:ContratacionEnmiendaToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayEnmiendasPrint;
}
function printCDocs(data){
    ArrayECDocsPrint= [];
    if (sizeObject(data)>0) {
        ArrayECDocsPrint.push(
            { text: "\nDocumentos de la Contratación", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['50%', '50%'],
                    body:ContratacionDocsToPdf(data),
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },

            { text: "\n\n\nInformación financiera", style: 'titulo' },
        )
    }
    return ArrayECDocsPrint;
}
function printGestioContratos(data){
    ArrayGestioContratossPrint= [];
    if (sizeObject(data)>0) {
        ArrayGestioContratossPrint.push(
            { text: "\nRenegociaciones ", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['16%','16%','16%','16%','16%','16%'],
                    body:ContratacionContratosToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayGestioContratossPrint;
}
function printDocsGestCont(data){
    ArrayDocsGestContPrint= [];
    if (sizeObject(data)>0) {
        ArrayDocsGestContPrint.push(
            { text: "\nDocumentos de la Renegociación", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['50%', '50%'],
                    body:ContratosDocsToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayDocsGestContPrint;
}

function basicImplementacion(data){
    ArrayImplementacionPrint= [];
    if (sizeObject(data)>0) {
        ArrayImplementacionPrint.push(
            {text: '\n\n\nImplementación\n\n', style:'titulo'},
            { text: "\nDatos de Contacto del Proveedor de Servicios", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{
                    widths: ['20%', '20%','20%','20%','20%'],
                    body:[
                        [{ text: "\nNombre", style:'contenido2'},{ text: "\nDirección", style:'contenido2'},{ text: "\nTeléfono Fijo", style:'contenido2'},{ text: "\nCorreo Electrónico", style:'contenido2'},{ text: "\nFecha de Inicio", style:'contenido2'}],
                        [data[0]['Nombres'],data[0]['direccion'],data[0]['telefono'],data[0]['email'],data[0]['fecha_inicio']],
                    ],
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayImplementacionPrint;
}
function printInversiones(data){
    ArrayInversionesPrint= [];
    if (sizeObject(data)>0) {
        ArrayInversionesPrint.push(
            { text: "\nInversiones Realizadas", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{
                    widths: ['25%', '25%','25%','25%'],
                    body:PlanDesembolsosToPdf(data),
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayInversionesPrint;
}
function printHitosImplementacion(data){
    ArrayHitosImplementacionPrint= [];
    if (sizeObject(data)>0) {
        ArrayHitosImplementacionPrint.push(
            { text: "\nHitos de Implementación", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{
                    widths: ['25%', '25%','25%','25%'],
                    body:HitosImplementacionToPdf(data),
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayHitosImplementacionPrint;
}
function printTarifas(data){
    ArrayHTarifasPrint= [];
    if (sizeObject(data)>0) {
        ArrayHTarifasPrint.push(
            { text: "\nTarifas", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{
                    widths: ['20%', '20%','20%','20%','20%'],
                    body:TarifasToPdf(data),
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayHTarifasPrint;
}
function printTransacciones(data){
    ArrayTransaccionesPrint= [];
    if (sizeObject(data)>0) {
        ArrayTransaccionesPrint.push(
            { text: "\nTransacciones", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{
                    widths: ['20%', '20%','20%','20%','20%'],
                    body:TransaccionToPdf(data),
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayTransaccionesPrint;
}
function printDocsImplementacion(data){
    ArrayDocsImplementacionPrint= [];
    if (sizeObject(data)>0) {
        ArrayDocsImplementacionPrint.push(
            { text: "\nDocumentos de la Implementación", style: 'header' },
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},

            { text: "\n" },
            {

                table:{

                    widths: ['50%', '50%'],
                    body:ImplementacionDocToPdf(data)
                },
                layout: {
                    fillColor: function (i, node) {
                        return (i % 2 === 0) ?  'white' : null;
                    },
                     hLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      vLineColor: function (i, node) {
                        return '#0984e3';
                      },
                      hLineWidth: function (i, node) {
                        return 1;
                      },
                      vLineWidth: function (i, node) {
                        return 1;
                    },
                }
            },
        )
    }
    return ArrayDocsImplementacionPrint;
}


function docsToPdf(dataDocs){

    ArrayDocs =[];
    ArrayDocs.push([
        {
            text: "\nTítulo",
            style:'contenido2'
        },
        {
            text: "\nDescripción",
            style:'contenido2'
        }]
    )
    dataDocs.forEach(function(row) {
        ArrayDocs.push(
            [
                {
                    text: "\n"+row["title"],
                    link: row["url"],
                    style:"linkStyle"},
                    {text: "\n"+row["description"]
                }
            ]);
    });
    return ArrayDocs;
}
function budgetToPdf(dataDocs){

    ArrayBudget =[];
    ArrayBudget.push([
        {
            text: "\nMonto",
            style:'contenido2'
        },
        {
            text: "\nMoneda",
            style:'contenido2'
        },
        {
            text: "\nDescripción",
            style:'contenido2'
        },
        {
            text: "\nFuente",
            style:'contenido2'
        },
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayBudget.push(
            [
                {text: "\n"+Intl.NumberFormat().format(row["amount"], 2)},
                {text: "\n"+row["currency"]},
                {text: "\n"+row["description"]},
                {text: "\n"+row["sourceParty_name"]},
            ]);
    });
    return ArrayBudget;
}

function beneficiariosToPdf(dataDocs){

    ArrayBeneficiario =[];
    ArrayBeneficiario.push([
        {
            text: "\nDepartamento",
            style:'contenido2'
        },
        {
            text: "\nMunicipio",
            style:'contenido2'
        },
        {
            text: "\nBeneficio",
            style:'contenido2'
        },
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayBeneficiario.push(
            [
                {text: "\n"+row["a"]},
                {text: "\n"+row["b"]},
                {text: "\n"+row["c"]},
            ]);
    });
    return ArrayBeneficiario;
}
function fuentesToPdf(dataDocs){

    ArrayFuentes =[];
    ArrayFuentes.push([
        {
            text: "\nFuente de financiamiento",
            style:'contenido2'
        },
        {
            text: "\nMonto",
            style:'contenido2'
        },
        {
            text: "\nMoneda",
            style:'contenido2'
        },
        {
            text: "\nTasa",
            style:'contenido2'
        },
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayFuentes.push(
            [
                {text: "\n"+row["a"]},
                {text: "\n"+Intl.NumberFormat().format(row["b"], 2)},
                {text: "\n"+row["c"]},
                {text: "\n"+row["d"]},
            ]);
    });
    return ArrayFuentes;
}

function precalificacionToPdf(dataDocs){
    ArrayPrecalificacion =[];
    ArrayPrecalificacion.push([
        {
            text: "\nFecha inicial",
            style:'contenido2'
        },
        {
            text: "\nFecha Final",
            style:'contenido2'
        },
        {
            text: "\nDuración en días",
            style:'contenido2'
        },
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayPrecalificacion.push(
            [
                {text: "\n"+row["startDate"]},
                {text: "\n"+row["endDate"]},
                {text: "\n"+row["durationInDays"]},
            ]);
    });
    return ArrayPrecalificacion;
}

function pronosticoToPdf(dataDocs){

    ArrayPronostico =[];
    ArrayPronostico.push([
        {
            text: "\nTítulo",
            style:'contenido2'
        },
        {
            text: "\nUnidad",
            style:'contenido2'
        },
        {
            text: "\nMedida",
            style:'contenido2'
        },
        {
            text: "\nMonto",
            style:'contenido2'
        },
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayPronostico.push(
            [
                {text: "\n"+row["title"]},
                {text: "\n"+row["unidad"]},
                {text: "\n"+row["medida"]},
                {text: "\n"+Intl.NumberFormat().format(row["obs_amount"], 2)},
            ]);
    });
    return ArrayPronostico;
}

function pHitosToPdf(dataDocs){

    ArrayPHitos =[];
    ArrayPHitos.push([
        {
            text: "\nTítulo",
            style:'contenido2'
        },
        {
            text: "\nDue Date",
            style:'contenido2'
        },
        {
            text: "\nDate Met",
            style:'contenido2'
        },
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayPHitos.push(
            [
                {text: "\n"+row["title"]},
                {text: "\n"+row["dueDate"]},
                {text: "\n"+row["dateMet"]},
            ]);
    });
    return ArrayPHitos;
}

function imprimirPlanificacion(){
    var dataProyecto;
    var dataProyectoDocs;
    var dataBudget;
    var dataBeneficiarios;
    var dataFuentes;

    var dataPronostico;
    var dataPHitos;
    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
        success: function (data) {
            dataProyecto = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoDocsPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
        success: function (data) {
            dataProyectoDocs = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoBudgetPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
        success: function (data) {
            dataBudget = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoBeneficiariosPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
        success: function (data) {
            dataBeneficiarios = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoFuentesPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
        success: function (data) {
            dataFuentes = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoPronosticoPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
        success: function (data) {
            dataPronostico = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoHitosPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
        success: function (data) {
            dataPHitos = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });



    var logo="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/logo.png";
    var docDefinitionProyecto = {
        content: [
            {image:"data:image/png;base64,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",width: 150},
            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd" }]},
            "\n\n",
            printBasicProject(dataProyecto),
            basicProject2(dataProyecto),
            printProjectDocs(dataProyectoDocs),
            printBeneficiarios(dataBeneficiarios),
            printFuentesFinanciamiento(dataFuentes),
            printPresupuesto(dataBudget),
            printPronostico(dataPronostico),
            printHitos(dataPHitos),
            printDatosFuncionarioProject(dataProyecto),


            imprimirContratacion(),
            //imprimirCalificacion(),
            //imprimirAdjudicacion(),

            imprimirImplementacion(),



        ],

        styles: {
            header: {
                fontSize: 15,

                color: 'black',
            },
            titulo: {
                fontSize: 25,
                bold: true,
                color: '#29a4dd',
            },
            contenido:{
                fontSize:12,
                alignment: 'justify',
            },
            contenido2:{
                fontSize:12,
                bold:true,
                alignment: 'center',
            },
            linkStyle:{
                fontSize:12,
                color: 'blue',
                underline:true,
            },


        }
    };
    return docDefinitionProyecto;

}
function oferentesToPdf(dataDocs){
    var numeroLinea=1;
    ArrayOferentes =[];
    ArrayOferentes.push([
        {
            text: "\nNo.",
            style:'contenido2'
        },
        {
            text: "\nNombre de los Oferentes",
            style:'contenido2'
        },
        ]
    );
    dataDocs.forEach(function(row) {
        ArrayOferentes.push(
            [
                {text: "\n"+numeroLinea.toString()},
                {text: "\n"+row["a"]},
            ]);
        numeroLinea=numeroLinea+1;
    });
    return ArrayOferentes;
}

function CalificacionDocsToPdf(dataDocs){

    ArrayDocs =[];
    ArrayDocs.push([
        {
            text: "\nTítulo",
            style:'contenido2'
        },
        {
            text: "\nDescripción",
            style:'contenido2'
        }]
    )
    dataDocs.forEach(function(row) {
        ArrayDocs.push(
            [
                {
                    text: "\n"+row["title"],
                    link: row["url"],
                    style:"linkStyle"},
                    {text: "\n"+row["description"]
                }
            ]);
    });
    return ArrayDocs;
}

function AdjudicacionDocsToPdf(dataDocs){

    ArrayDocs =[];
    ArrayDocs.push([
        {
            text: "\nTítulo",
            style:'contenido2'
        },
        {
            text: "\nDescripción",
            style:'contenido2'
        }]
    )
    dataDocs.forEach(function(row) {
        ArrayDocs.push(
            [
                {
                    text: "\n"+row["title"],
                    link: row["url"],
                    style:"linkStyle"},
                    {text: "\n"+row["description"]
                }
            ]);
    });
    return ArrayDocs;
}
function AdjudicacionOferentesPreferidosToPdf(dataDocs){

    ArrayOferentesPreferidos =[];
    ArrayOferentesPreferidos.push([
        {
            text: "\nOferentes",
            style:'contenido2'
        }]
    )
    dataDocs.forEach(function(row) {
        ArrayOferentesPreferidos.push(
            [

                    {text: "\n"+row["legalName"]}

            ]);
    });
    return ArrayOferentesPreferidos;
}
function ContratacionFirmantesToPdf(dataDocs){

    ArrayContratacionFirmantes =[];
    ArrayContratacionFirmantes.push([
        {
            text: "\nFirmantes",
            style:'contenido2'
        }]
    )
    dataDocs.forEach(function(row) {
        ArrayContratacionFirmantes.push(
            [

                    {text: "\n"+row["parties_name"]}

            ]);
    });
    return ArrayContratacionFirmantes;
}

function ContratacionOrganizacionToPdf(dataDocs){

    ArrayContratacionOrganizacion =[];
    ArrayContratacionOrganizacion.push([
        {
            text: "\nOrganización",
            style:'contenido2'
        }]
    )
    dataDocs.forEach(function(row) {
        ArrayContratacionOrganizacion.push(
            [

                    {text: "\n"+row["legalName"]}

            ]);
    });
    return ArrayContratacionOrganizacion;
}

function ContratacionAccionistaToPdf(dataDocs){

    ArrayContratacionAccionista =[];
    ArrayContratacionAccionista.push(
        [
            {text: "\nNombre", style:'contenido2'},
            {text: "\nDerechos de Votación", style:'contenido2'},
            {text: "\nDetalles del derecho de votación", style:'contenido2'},
            {text: "\nAccionado", style:'contenido2'},
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayContratacionAccionista.push(
            [

                    {text: "\n"+row["shareholder_name"]},
                    {text: "\n"+row["votingRights"]},
                    {text: "\n"+row["votingRightsDetails"]},
                    {text: "\n"+row["shareholding"]},

            ]);
    });
    return ArrayContratacionAccionista;
}

function ContratacionGovGarantiaToPdf(dataDocs){

    ArrayContratacionGovGarantia =[];
    ArrayContratacionGovGarantia.push(
        [
            {text: "\nTítulo", style:'contenido2'},
            {text: "\nCategoria de Financiación", style:'contenido2'},
            {text: "\nFecha Inicio", style:'contenido2'},
            {text: "\nFecha Final", style:'contenido2'},
            {text: "\nMonto", style:'contenido2'},
            {text: "\nMoneda", style:'contenido2'},
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayContratacionGovGarantia.push(
            [

                    {text: "\n"+row["title"]},
                    {text: "\n"+row["financeCategory"]},
                    {text: "\n"+row["startDate"]},
                    {text: "\n"+row["endDate"]},
                    {text: "\n"+Intl.NumberFormat().format(row["amount"], 2)},
                    {text: "\n"+row["currency"]},

            ]);
    });
    return ArrayContratacionGovGarantia;
}

function ContratacionRiskToPdf(dataDocs){

    ArrayContratacionRisk =[];
    ArrayContratacionRisk.push(
        [
            {text: "\nDescripción", style:'contenido2'},
            {text: "\nResponsable", style:'contenido2'},
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayContratacionRisk.push(
            [

                {text: "\n"+row["description"]},
                {text: "\n"+row["legalName"]},

            ]);
    });
    return ArrayContratacionRisk;
}

function ContratacionRatioToPdf(dataDocs){

    ArrayContratacionRatio =[];
    ArrayContratacionRatio.push(
        [
            {text: "\nEquidad de capital de la deuda", style:'contenido2'},
            {text: "\nCantidad del capital social", style:'contenido2'},
            {text: "\nMoneda del capital social", style:'contenido2'},
            {text: "\nDetalles de la razón de la equidad de la deuda", style:'contenido2'},
            {text: "\nRelación de subsidio", style:'contenido2'},
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayContratacionRatio.push(
            [

                {text: "\n"+row["debtEquityRatio"]},
                {text: "\n"+Intl.NumberFormat().format(row["shareCapital_amount"], 2)},
                {text: "\n"+row["shareCapital_currency"]},
                {text: "\n"+row["debtEquityRatioDetails"]},
                {text: "\n"+row["subsidyRatio"]},

            ]);
    });
    return ArrayContratacionRatio;
}

function ContratacionIrrToPdf(dataDocs){

    ArrayContratacionIrr =[];
    ArrayContratacionIrr.push(
        [
            {text: "\nTítulo", style:'contenido2'},
            {text: "\nDescripción", style:'contenido2'},
            {text: "\nDuración de periodo en días", style:'contenido2'},
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayContratacionIrr.push(
            [

                {text: "\n"+row["title"]},
                {text: "\n"+row["description"]},
                {text: "\n"+row["period_durationInDays"]},

            ]);
    });
    return ArrayContratacionIrr;
}

function ContratacionShareCapitalToPdf(dataDocs){

    ArrayContratacionShareCapital =[];
    ArrayContratacionShareCapital.push(
        [
            {text: "\nRatio de capital de la deuda", style:'contenido2'},
            {text: "\nMonto del capital compartido", style:'contenido2'},
            {text: "\nMoneda del capital compartido", style:'contenido2'},
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayContratacionShareCapital.push(
            [

                {text: "\n"+row["debtEquityRatio"]},
                {text: "\n"+Intl.NumberFormat().format(row["shareCapital_amount"], 2)},
                {text: "\n"+row["shareCapital_currency"]},

            ]);
    });
    return ArrayContratacionShareCapital;
}

function ContratacionEnmiendaToPdf(dataDocs){

    ArrayContratacionEnmienda =[];
    ArrayContratacionEnmienda.push(
        [
            {text: "\nDescripción", style:'contenido2'},
            {text: "\nFecha", style:'contenido2'},
            {text: "\nRazón", style:'contenido2'},
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayContratacionEnmienda.push(
            [

                {text: "\n"+row["description"]},
                {text: "\n"+row["date"]},
                {text: "\n"+row["rationale"]},

            ]);
    });
    return ArrayContratacionEnmienda;
}

function ContratacionDocsToPdf(dataDocs){

    ArrayCDocs =[];
    ArrayCDocs.push([
        {
            text: "\nTítulo",
            style:'contenido2'
        },
        {
            text: "\nDescripción",
            style:'contenido2'
        }]
    )
    dataDocs.forEach(function(row) {
        ArrayCDocs.push(
            [
                {
                    text: "\n"+row["title"],
                    link: row["url"],
                    style:"linkStyle"},
                    {text: "\n"+row["description"]
                }
            ]);
    });
    return ArrayCDocs;
}

function ContratacionContratosToPdf(dataDocs){

    ArrayContratacionContratos =[];
    ArrayContratacionContratos.push(
        [
            {text: "\nNúmero de modificación", style:'contenido2'},
            {text: "\nFecha de modificación del contrato", style:'contenido2'},
            {text: "\nTipo de modificación", style:'contenido2'},
            {text: "\nJustificación de contrato", style:'contenido2'},
            {text: "\nCambio en el precio original del contrato", style:'contenido2'},
            {text: "\nAlcance actual del contrato", style:'contenido2'},
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayContratacionContratos.push(
            [

                {text: "\n"+row["nmodifica"]},
                {text: "\n"+row["fecha"]},
                {text: "\n"+row["tipomodifica"]},
                {text: "\n"+row["justimodcontrato"]},
                {text: "\n"+Intl.NumberFormat().format(row["precioactual"], 2)},
                {text: "\n"+row["alcanceactucontrato"]},
            ]);
    });
    return ArrayContratacionContratos;
}

function ContratosDocsToPdf(dataDocs){

    ArrayContratosDocs =[];
    ArrayContratosDocs.push([
        {
            text: "\nTítulo",
            style:'contenido2'
        },
        {
            text: "\nDescripción",
            style:'contenido2'
        }]
    )
    dataDocs.forEach(function(row) {
        ArrayContratosDocs.push(
            [
                {
                    text: "\n"+row["title"],
                    link: row["url"],
                    style:"linkStyle"},
                    {text: "\n"+row["description"]
                }
            ]);
    });
    return ArrayContratosDocs;
}

function PlanDesembolsosToPdf(dataDocs){

    ArrrayPlanDesembolsos =[];
    ArrrayPlanDesembolsos.push(
        [
            {text: "\nNúmero", style:'contenido2'},
            {text: "\nDescripción", style:'contenido2'},
            {text: "\nMonto", style:'contenido2'},
            {text: "\nFecha desembolso", style:'contenido2'},
        ]
    )
    dataDocs.forEach(function(row) {
        ArrrayPlanDesembolsos.push(
            [

                {text: "\n"+row["desembolso"]},
                {text: "\n"+row["descripcion"]},
                {text: "\n"+Intl.NumberFormat().format(row["monto"], 2)},
                {text: "\n"+row["fecha_desembolso"]},
            ]);
    });
    return ArrrayPlanDesembolsos;
}

function HitosImplementacionToPdf(dataDocs){

    ArrrayHitosImplementacion =[];
    ArrrayHitosImplementacion.push(
        [
            {text: "\nTítulo", style:'contenido2'},
            {text: "\nDescripción", style:'contenido2'},
            {text: "\nFecha Prometida", style:'contenido2'},
            {text: "\nFecha Entrega", style:'contenido2'},
        ]
    )
    dataDocs.forEach(function(row) {
        ArrrayHitosImplementacion.push(
            [

                {text: "\n"+row["title"]},
                {text: "\n"+row["description"]},
                {text: "\n"+row["dueDate"]},
                {text: "\n"+row["dateMet"]},
            ]);
    });
    return ArrrayHitosImplementacion;
}

function TarifasToPdf(dataDocs){

    ArrayTarifas =[];
    ArrayTarifas.push(
        [
            {text: "\nTítulo", style:'contenido2'},
            {text: "\nNotas", style:'contenido2'},
            {text: "\nDimensiones", style:'contenido2'},
            {text: "\nMonto", style:'contenido2'},
            {text: "\nMoneda", style:'contenido2'},
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayTarifas.push(
            [
                {text: "\n"+row["tittle"]},
                {text: "\n"+row["notes"]},
                {text: "\n"+row["dimensions"]},
                {text: "\n"+Intl.NumberFormat().format(row["amount"], 2)},
                {text: "\n"+row["currency"]},
            ]);
    });
    return ArrayTarifas;
}

function TransaccionToPdf(dataDocs){

    ArrayTransaccion =[];
    ArrayTransaccion.push(
        [
            {text: "\nFecha", style:'contenido2'},
            {text: "\nNombre de Pagador", style:'contenido2'},
            {text: "\nNombre del Beneficiario", style:'contenido2'},
            {text: "\nMonto", style:'contenido2'},
            {text: "\nMoneda", style:'contenido2'},
        ]
    )
    dataDocs.forEach(function(row) {
        ArrayTransaccion.push(
            [

                {text: "\n"+row["date"]},
                {text: "\n"+row["payer_name"]},
                {text: "\n"+row["payee_name"]},
                {text: "\n"+Intl.NumberFormat().format(row["amount"], 2)},
                {text: "\n"+row["currency"]},
            ]);
    });
    return ArrayTransaccion;
}

function ImplementacionDocToPdf(dataDocs){

    ArrayImplementacionDoc =[];
    ArrayImplementacionDoc.push([
        {
            text: "\nTítulo",
            style:'contenido2'
        },
        {
            text: "\nDescripción",
            style:'contenido2'
        }]
    )
    dataDocs.forEach(function(row) {
        ArrayImplementacionDoc.push(
            [
                {
                    text: "\n"+row["title"],
                    link: row["url"],
                    style:"linkStyle"},
                    {text: "\n"+row["description"]
                }
            ]);
    });
    return ArrayImplementacionDoc;
}


function imprimirCalificacion(){
    var docDefinitionCalificacion =[];
    var dataCalificacion;
    var dataOferentes;
    var dataCalificacionDocs;
    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BCalificacionPdf");?>' + "&criterio=" + '<?php echo $valorIdCalificacion?>',
        success: function (data) {
            dataCalificacion = JSON.parse(data);
            //console.log(dataCalificacion.length);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });
    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BOferentesPdf");?>' + "&criterio=" + '<?php echo $valorIdCalificacion?>',
        success: function (data) {
            dataOferentes = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BCalificacionDocsPdf");?>' + "&criterio=" + '<?php echo $valorIdCalificacion?>',
        success: function (data) {
            dataCalificacionDocs = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    docDefinitionCalificacion.push(
        basicCalificacion(dataCalificacion),

        printOferentesParticipantes(dataOferentes),
        printDocsCalificacion(dataCalificacionDocs),
        printFuncionarioCalificacion(dataCalificacion)
    );
    return docDefinitionCalificacion;
}

function imprimirAdjudicacion(){
    var docDefinitionAdjudicacion =[];
    var dataAdjudicacion;
    var dataAdjudicacionDocs;
    var dataOferentesPreferidos;
    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BAdjudicacionPdf");?>' + "&criterio=" + '<?php echo $valorIdAdjudicacion?>',
        success: function (data) {
            dataAdjudicacion = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BAdjudicacionDocsPdf");?>' + "&criterio=" + '<?php echo $valorIdAdjudicacion?>',
        success: function (data) {
            dataAdjudicacionDocs = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BAdjudicacionOferentesPreferidosPdf");?>' + "&criterio=" + '<?php echo $valorIdAdjudicacion?>',
        success: function (data) {
            dataOferentesPreferidos = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    docDefinitionAdjudicacion.push(
            basicAdjudicacion(dataAdjudicacion),
            printDocsAdjudicacion(dataAdjudicacionDocs),
            printOferentesPreferidos(dataOferentesPreferidos),
        );
        return docDefinitionAdjudicacion;
}

function imprimirContratacion(){
    var docDefinitionContratacion =[];
    var dataContratacion;
    var dataContratacionDocs;
    var dataFirmantes;
    var dataOrganizacion;
    var dataAccionista;
    var dataPrestamista;
    var dataGovGarantia;
    var dataRisk;
    var dataRatio;
    var dataIrr;
    var dataShareCapital;
    var dataEnmienda;
    var dataContratos;
    var dataContratosDocs;
    var dataPrecalificacion;
    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataContratacion = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionFirmantesPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataFirmantes = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionOrganizacionPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataOrganizacion = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionAccionistasPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataAccionista = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionPrestamistaPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataPrestamista = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionGovGarantiaPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataGovGarantia = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionRiskPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataRisk = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionRatioPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataRatio = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionIrrPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataIrr = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionShareCapitalPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataShareCapital = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionEnmiendaPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataEnmienda = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionDocsPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataContratacionDocs = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratosPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataContratos = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BContratoDocsPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
        success: function (data) {
            dataContratosDocs = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoPrecalificacionPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
        success: function (data) {
            dataPrecalificacion = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });
    docDefinitionContratacion.push(
            printPreCalificacion(dataPrecalificacion),
            imprimirCalificacion(),
            imprimirAdjudicacion(),
            basicContratacion(dataContratacion),
            printCDocs(dataContratacionDocs),
            printGarantiaGovierno(dataGovGarantia),
            printRiesgos(dataRisk),
            printRatio(dataRatio),
            printTir(dataIrr),
            printCapitalCompartido(dataShareCapital),
            printFirmantes(dataFirmantes),
            printDetallesOrganizacion(dataOrganizacion),
            printAccionista(dataAccionista),
            printPrestamista(dataPrestamista),
            printEnmiendas(dataEnmienda),
            printGestioContratos(dataContratos),
            printDocsGestCont(dataContratosDocs),




        );
        return docDefinitionContratacion;
}

function imprimirImplementacion(){
    var docDefinitionImplementacion=[];
    var dataImplementacion;
    var dataPlanDesembolsos;
    var dataHitosImplementacion;
    var dataTarifas;
    var dataTransaccion;
    var dataImplementacionDoc;

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BImplementacionContactoPdf");?>' + "&criterio=" + '<?php  echo $valorIdInicioEjecucion;?>',
        success: function (data) {
            dataImplementacion = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });


    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BPlanDesembolsoPdf");?>' + "&criterio=" + '<?php  echo $valorIdInicioEjecucion;?>',
        success: function (data) {
            dataPlanDesembolsos = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BHitosImplementacionPdf");?>' + "&criterio=" + '<?php  echo $valorIdInicioEjecucion;?>',
        success: function (data) {
            dataHitosImplementacion = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BTarifasPdf");?>' + "&criterio=" + '<?php  echo $valorIdInicioEjecucion;?>',
        success: function (data) {
            dataTarifas = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BTransaccionPdf");?>' + "&criterio=" + '<?php  echo $valorIdInicioEjecucion;?>',
        success: function (data) {
            dataTransaccion = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    $.ajax({
        async: false,
        type: 'GET',
        url: '<?php echo CController::createUrl("/Ciudadano/BImplementacionDocPdf");?>' + "&criterio=" + '<?php  echo $valorIdInicioEjecucion;?>',
        success: function (data) {
            dataImplementacionDoc = JSON.parse(data);
        },
        error: function (data) { // if error occured
            console.log("Error");
        },
        dataType: 'html'
    });

    docDefinitionImplementacion.push(
        basicImplementacion(dataImplementacion),
        printInversiones(dataPlanDesembolsos),
        printHitosImplementacion(dataHitosImplementacion),
        printTarifas(dataTarifas),
        printTransacciones(dataTransaccion),
        printDocsImplementacion(dataImplementacionDoc),

    );
    return docDefinitionImplementacion;
}
function imprimirFicha(){

    var docDefinition = imprimirPlanificacion();

    pdfMake.createPdf(docDefinition).open();

}