<!DOCTYPE html>
<html>
<body>
	<table style="width: 75%; margin: auto;">
		<tr style="vertical-align: top;">
			<td>
				<h1>ThemisCase</h1>
				<p>Su socio tecnologico</p>
			</td>
			<td style="text-align: right;">
				<h1>LawFirm Logo</h1>
			</td>
		</tr>
		<tr style="vertical-align: top;">
			<td>
				{{ $phisicalAddress }}
			</td>
			<td style="text-align: right;">
				<h2>{{ $name }}</h2>
				<h3>{{ $type }}</h3>
				<p>{{ $nationallity }}</p>
				<p>{{ $email }}</p>
				<p>{{ $phone }}</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table>
					<tr>
						<td>
							<h2>Personas Juridicas</h2>
						</td>
					</tr>
					<tr>
						<td>
							{{ $legal_relations }}							
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<p>{{ $lawFirmContacts }}</p>
			</td>
			
		</tr>
	</table>
</body>
</html>