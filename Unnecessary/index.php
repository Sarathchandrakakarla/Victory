<input type="button" onclick="export_data()" value="Export">
<table id="data">
	<tr>
		<td>S.No</td>
		<td>Name</td>
	</tr>
	<?php 
		for($i=1;$i<50001;$i++){
			echo "<tr>
				<td>$i</td>
				<td>Vishal$i</td>
			</tr>";
		}
	?>
</table>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
function export_data(){
	let data=document.getElementById('data');
	var fp=XLSX.utils.table_to_book(data,{sheet:'vishal'});
	XLSX.write(fp,{
		bookType:'xlsx',
		type:'base64'
	});
	XLSX.writeFile(fp, 'test.xlsx');
}
</script>