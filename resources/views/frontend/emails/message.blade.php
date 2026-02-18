<!DOCTYPE html>
<html lang="{{app()->currentLocale()}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje</title>



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



                                                        <table border="0" cellspacing="0" cellpadding="0" role="presentation" style="font-family:Poppins,sans-serif;font-weight:400;color:#141414;line-height:1.2;font-size:16px  border-collapse: separate; border-spacing: 0 10px;">
                                                            <tbody style="font-size:16px; vertical-align: top">
                                                                <tr>

                                                                    <td style="padding-bottom:20px" colspan="2">

                                                                        <span style="font-family:Poppins;font-size:24px;font-weight:600; color:#141414;">
                                                                            Mensaje
                                                                        </span>

                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <span style=" color: #18b2de; padding-right: 10px; ">
                                                                            Name:
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <span style=" color:#141414;">
                                                                            {{ $data['name'] }}
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <span style="color: #18b2de; padding-right: 10px;">
                                                                            Email:
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <span style="color:#141414;">
                                                                            {{ $data['email'] }}
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <span style="color: #18b2de; padding-right: 10px;">
                                                                            Message:
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <span style="color:#141414;">
                                                                            {{ $data['message'] }}
                                                                        </span>
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