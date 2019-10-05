<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=windows-1252">
    <meta name=Generator content="Microsoft Word 15 (filtered)">
    <style>
        
        @font-face {
            font-family: "Cambria Math";
            panose-1: 0 0 0 0 0 0 0 0 0 0;
        }

        @font-face {
            font-family: "Calibri Light";
            panose-1: 2 15 3 2 2 2 4 3 2 4;
        }

        @font-face {
            font-family: Calibri;
            panose-1: 2 15 5 2 2 2 4 3 2 4;
        }

        /* Style Definitions */
        p.MsoNormal, li.MsoNormal, div.MsoNormal {
            margin-top: 0in;
            margin-right: 0in;
            margin-bottom: 10.0pt;
            margin-left: 0in;
            line-height: 115%;
            font-size: 11.0pt;
            font-family: "Calibri", "sans-serif";
        }

        h1 {
            mso-style-link: "Heading 1 Char";
            margin-top: 24.0pt;
            margin-right: 0in;
            margin-bottom: 0in;
            margin-left: 0in;
            margin-bottom: .0001pt;
            line-height: 115%;
            page-break-after: avoid;
            font-size: 14.0pt;
            font-family: "Calibri Light", "sans-serif";
            color: #2E74B5;
        }

        a:link, span.MsoHyperlink {
            color: #0563C1;
            text-decoration: underline;
        }

        a:visited, span.MsoHyperlinkFollowed {
            color: #954F72;
            text-decoration: underline;
        }

        span.Heading1Char {
            mso-style-name: "Heading 1 Char";
            mso-style-link: "Heading 1";
            font-family: "Calibri Light", "sans-serif";
            color: #2E74B5;
            font-weight: bold;
        }

        .MsoChpDefault {
            font-family: "Calibri", "sans-serif";
        }

        .MsoPapDefault {
            margin-bottom: 8.0pt;
            line-height: 107%;
        }

        @page WordSection1 {
            size: 8.5in 11.0in;
            margin: 1.0in 1.0in 1.0in 1.0in;
        }

        div.WordSection1 {
            page: WordSection1;
        }  
    </style>

</head>

<body lang=EN-US link="#0563C1" vlink="#954F72">

<div class=WordSection1>

    
    </div>

    <p class=MsoNormal align=center style='text-align:center'>&nbsp;</p>

    <p class=MsoNormal>Greetings ({{ $emaildata[0]['yccsupport_from']  }}),</p>

    <p class=MsoNormal>&nbsp;</p>

    <p class=MsoNormal>Thank you for contacting our support team. A new support
        ticket has now been opened for your request. You will be notified by an email,
        once a response is made. The details of your ticket are shown below. </p>

    <p class=MsoNormal>&nbsp;</p>

    <p class=MsoNormal><b><u>Ticket ID</u> # </b>{{ $emaildata[0]['yccsupport_id']  }}</p>

    <p class=MsoNormal><b><u>Subject</u>: </b>{{ $emaildata[0]['yccsupport_subject']  }}</p>

    <p class=MsoNormal><b><u>Status</u>: </b>New</p>

    {{-- <p class=MsoNormal><b><u>Ticket URL</u>:  </b><a
            href="{{ route('yccsupport.detail',$emaildata[0]['yccsupport_id']) }}">{{ route('yccsupport.detail',$emaildata[0]['yccsupport_id']) }}</a>
    </p> --}}

    <div style='border:none;border-bottom:double windowtext 2.25pt;padding:0in 0in 1.0pt 0in'>

        <p class=MsoNormal style='border:none;padding:0in'>&nbsp;</p>

    </div>

    <p class=MsoNormal>Best Regards,</p>

    <p class=MsoNormal>YCC Support Team</p>

    <p class=MsoNormal><a href="https://www.yourcloudcampus.com">https://www.yourcloudcampus.com</a></p>

    <p class=MsoNormal><b><u>Our Hotlines</u>: </b></p>

    <p class=MsoNormal><b>
        UK: (203) 334-9939<br>
        USA: (202) 886-1222<br>
        AUS: (129) 161-2887<br>
        SG: 6958- 0826 |<br>                 
    <p class=MsoNormal>&nbsp;</p>

</div>

</body>

</html>
