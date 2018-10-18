function validaCampo()
{
	for (i = 0; i < document.frmDados.elements.length; i++)
    { 
		var campo = document.frmDados.elements[i];

		if (campo.value == '')
		{
			alert('Preecha o campo ' + campo.name.substr(3));

			campo.focus();

			return false;
		}
  	} 
}