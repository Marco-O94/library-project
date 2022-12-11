<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-family: Helvetica, sans-serif;
        }

        @media screen and (max-width: 530px) {
            .unsub {
                display: block;
                padding: 8px;
                margin-top: 14px;
                border-radius: 6px;
                background-color: #F3F4F6;
                text-decoration: none !important;
                font-weight: bold;
            }

            .col-lge {
                max-width: 100% !important;
            }
        }
    </style>
</head>

<body style="margin:0;padding:0;word-spacing:normal;background-color:#F3F4F6;">
    <div role="article" aria-roledescription="email" lang="it"
        style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f3f4f6;">
        <table role="presentation" style="width:100%;border:none;border-spacing:0;">
            <tr>
                <td align="center" style="padding:0;">
                    <!--[if mso]>
          <table role="presentation" align="center" style="width:600px;">
          <tr>
          <td>
          <![endif]-->
                    <table role="presentation"
                        style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Helvetica,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                        <!--LOGO-->
                        <tr>
                            <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="#" style="text-decoration:none;"><img
                                        src="https://cdn-icons-png.flaticon.com/512/3145/3145765.png" width="165" alt="Logo"
                                        style="width:165px;max-width:80%;height:auto;border:none;text-decoration:none;color:#ffffff;"></a>
                            </td>
                        </tr>
        <!-- Header -->
<!-- Inizio Contenuto -->
@yield('content')
<!-- Fine Contenuto -->

<!-- Footer -->
<tr>
    <td
        style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#ffffff;">
        <p style="margin:0 0 8px 0;"><a href="https://www.linkedin.com/in/oliveri-marco/"
                style="text-decoration:none;"><img
                    src="https://cdn-icons-png.flaticon.com/512/3536/3536505.png" width="40" height="40"
                    alt="facebook" style="display:inline-block;color:#ffffff;"></a> <a
                href="https://github.com/Marco-O94" style="text-decoration:none;"><img
                    src="https://cdn-icons-png.flaticon.com/512/2111/2111432.png" width="40" height="40"
                    alt="github" style="display:inline-block;color:#ffffff;"></a></p>
        Libreria Digitale
        </p>
        <p>Via test, 10</p>
    </td>
</tr>
                    </table>
</div>
</body>
</html>
