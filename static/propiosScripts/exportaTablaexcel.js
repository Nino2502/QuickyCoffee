// JavaScript Document



function exportarReporte(){
	
	
	
	
	
	
	 $tabla = document.querySelector("#tabla");
	
	//console.log( $tabla);
	
	
	 let tableExport = new TableExport($tabla, {
            exportButtons: false, // No queremos botones
            filename: "Reporte SDI", //Nombre del archivo de Excel
            sheetname: "Reporte SDI", //Título de la hoja
        });
        let datos = tableExport.getExportData();
        let preferenciasDocumento = datos.tabla.xlsx;
        tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType, preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento.merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);
	
	
}

