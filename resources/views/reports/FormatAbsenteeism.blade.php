<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml" lang="es">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>FORMATO DE CONTROL DE AUSENTISMO</title>
        <style type="text/css">
            @page {
                margin: .5cm 1cm 1cm 1cm;
            }

            body {
                font-family: Calibri, Arial, sans-serif;
                font-size: 14px;
                margin: 0.5cm 0;
                text-align: justify;
            }
            table{
                width: 100%;
                border-collapse: collapse;
                border: solid 1px black;
                font-size: 11px;
            }
            td, th {
                border: solid 1px black;
            }
        </style>
    </head>

    <body>
        <div class="page">
            <table>
                <tr style="text-align: center !important;">
                    <th colspan="2">
                        <img width="90" src="./images/Logo_CAFASUR.png" alt="Logo Cafasur">
                    </th>
                    <th colspan="2">
                        <h2>PROCESO DE RECURSO HUMANO</h2>
                        <h3>FORMATO DE CONTROL DE AUSENTISMO</h3>
                    </th>
                    <th colspan="2">
                        <h3>Versión 2</h3>
                        <h3>Pag 1 de 1</h3>
                    </th>
                </tr>
                <tr>
                    <td style="background: lightgrey" colspan="2">
                        <strong>Fecha de elaboracion:</strong>
                    </td>
                    <td colspan="2">{{ $absenteeismControl->created_at->format('l, d-m-Y') }}</td>
                    <td style="background: lightgrey">
                        <strong>No. permiso:</strong>
                    </td>
                    <td>{{ $absenteeismControl->id }}</td>
                </tr>
                <tr>
                    <td style="background: lightgrey" colspan="2">
                        <strong>Empleado:</strong>
                    </td>
                    <td colspan="2">{{ $absenteeismControl->user->full_name }}</td>
                    <td style="background: lightgrey">
                        <strong>C.C No.:</strong>
                    </td>
                    <td>{{ $absenteeismControl->user->document }}</td>
                </tr>
                <tr>
                    <td colspan="6" style="height: 10px;"></td>
                </tr>
                <tr>
                    <td style="background: lightgrey" colspan="2">
                        <strong>Fecha y hora del permiso:</strong>
                    </td>
                    <td colspan="2">{{ $absenteeismControl->permission_date }}</td>
                    <td rowspan="7" colspan="2" style="width: 20%; vertical-align: top; text-align: center;">Sello de radicación</td>
                </tr>
                <tr>
                    <td style="background: lightgrey" colspan="2">
                        <strong>Motivo del permiso:</strong>
                    </td>
                    <td colspan="4">{{ $absenteeismControl->absenteeism_type->name }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center !important; background: lightgrey">
                        <strong>Detalle del permiso</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="height: 110px; text-align: center;">{{ $absenteeismControl->detail_permission }}</td>
                </tr>
                <tr style="text-align: center !important; vertical-align: top;">
                    <td style="height: 110px; width: 20%;" colspan="2">Solicita</td>
                    <td style="width: 20%;">V.B Jefe Inmediato</td>
                    <td style="width: 20%;">V.B Directora Administrativa</td>
                </tr>
                <tr style="text-align: center !important;">
                    <td colspan="2">{{ $absenteeismControl->created_at->toDateString() }}</td>
                    <td style="height: 20px; color: lightgray;">DD MM AAAA</td>
                    <td style="color: lightgray;">DD MM AAAA</td>
                </tr>
                <tr style="text-align: center !important;">
                    <td colspan="2">{{ $absenteeismControl->created_at->format('h:i A') }}</td>
                    <td style="height: 20px; color: lightgray;">HH:MM</td>
                    <td style="color: lightgray;">HH:MM</td>
                </tr>
            </table>
        </div>
    </body>
</html>
