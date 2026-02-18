<!DOCTYPE html>
<html lang="{{app()->currentLocale()}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de contraseña</title>



    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap');
    </style>

</head>

<body style="margin:0;padding:0" bgcolor="#FAFAFA">

    <div style="margin:0;padding:0" bgcolor="#FAFAFA">

        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" lang="uk" bgcolor="#FAFAFA" role="presentation">


            <tbody>

                <tr>

                    <td>
                        <table width="100%" cellspacing="0" cellpadding="0" bgcolor="#FAFAFA" role="presentation">

                            <tbody>

                                <tr>

                                    <td style="padding:30px 20px 30px 20px;">




                                        <table width="100%" cellspacing="0" cellpadding="0" role="presentation">
                                            <tbody>
                                                <tr>
                                                    <td bgcolor="#fafafa" style="border-radius:4px">



                                                        <table border="0" cellspacing="0" cellpadding="0" role="presentation" style="font-family:Poppins,sans-serif;font-weight:400;color:#141414;line-height:1.2;font-size:16px">
                                                            <tbody>
                                                                <tr>

                                                                    <td style="padding-bottom:20px">

                                                                        <span style="font-family:Poppins;font-size:36px;font-weight:600; color:#27ba24;">
                                                                            TRIXY
                                                                        </span>

                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td style="padding-bottom:20px">
                                                                        <span style="font-size:20px;font-weight:600; color:#141414;">
                                                                            Recuperación de contraseña
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding-bottom:10px">
                                                                        <span style="font-size:18px;color:#141414; font-weight:500;">
                                                                            Puedes crear una nueva contraseña usando el siguiente enlace:
                                                                        </span>

                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td style="padding-bottom:40px">

                                                                        <span style="font-size:18px;font-weight:500;">
                                                                            <a style="color:#18b2de;" href="{{ route('reset.password', $data['token']) }}" target="_blank">
                                                                                {{ __('Establecer nueva contraseña') }}
                                                                            </a>

                                                                        </span>
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <span style="color:#141414; font-weight:400; font-style: italic;">
                                                                            Si no estás solicitando recuperar tu contraseña en el sitio, puedes ignorar este correo.
                                                                        </span>
                                                                        <a style="color:#18b2de;" href="{{ route('home') }}">
                                                                            {{ route('home') }}
                                                                        </a>

                                                                    </td>

                                                                </tr>

                                                            </tbody>
                                                        </table>



                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>



                                    </td>

                                </tr>




                            </tbody>



                        </table>

                    </td>
                </tr>

            </tbody>

        </table>


    </div>

</body>

</html>