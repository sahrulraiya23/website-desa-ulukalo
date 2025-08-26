<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Desa</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .kop-desa {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .kop-desa .title {
            font-weight: bold;
            font-size: 16pt;
            letter-spacing: 0.5px;
            margin: 5px 0;
        }

        .kop-desa .sub {
            font-weight: bold;
            font-size: 14pt;
            margin: 3px 0;
        }

        .kop-desa .addr {
            font-size: 10pt;
            margin: 5px 0;
        }

        .judul-surat {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
            margin: 20px 0 10px 0;
        }

        .nomor-surat {
            text-align: center;
            margin: 5px 0 20px 0;
        }

        p {
            margin: 10px 0;
            text-align: justify;
            text-indent: 30px;
        }

        table {
            border-collapse: collapse;
            margin: 15px 0;
        }

        table td {
            padding: 2px 0;
            vertical-align: top;
        }

        ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        ul li {
            margin: 5px 0;
        }

        .ttd-container {
            margin-top: 40px;
            text-align: right;
        }

        .ttd {
            display: inline-block;
            text-align: center;
            width: 250px;
        }

        .ttd>div {
            margin: 5px 0;
        }

        .ttd .nm {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }

        .ttd .nip {
            margin-top: 2px;
        }

        /* Styling khusus untuk tabel data */
        .data-table {
            width: 100%;
            margin: 15px 0;
        }

        .data-table td:first-child {
            width: 190px;
            padding-right: 10px;
        }

        .data-table td:nth-child(2) {
            width: 20px;
        }

        /* Reset indentasi untuk paragraf dalam konteks tertentu */
        .kop-desa p,
        .ttd p {
            text-indent: 0;
            text-align: center;
        }
    </style>
</head>

<body>
    {!! $content !!}
</body>

</html>
