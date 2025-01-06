<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Email</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <link href="{{ asset('css/bootstrap-rtl.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app-rtl.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.css') }}">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
</head>

<style>
    body {
        background-color: #0051a2;
        margin-top: 20px;
        margin-bottom: 20px;
        font-family: Arial, sans-serif;
    }
    .email-container {
        background-color: #ffffff;
        width: 650px;
        margin: 0 auto;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .email-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .email-header img {
        max-width: 150px;
        height: auto;
    }
    .email-content h1, .email-content h2 {
        margin: 0;
        padding-bottom: 15px;
        font-size: 24px;
        color: #0f3462;
    }
    .email-content p {
        line-height: 1.6;
        font-size: 16px;
        color: #555;
    }
    .btn {
        background-color: #36b445;
        color: white;
        padding: 15px 97px;
        display: block;
        margin: 25px auto;
        border-radius: 31px;
        font-weight: bold;
        text-transform: uppercase;
        text-align: center;
        text-decoration: none;
    }
    .footer {
        text-align: center;
        font-size: 14px;
        color: #888;
        padding-top: 20px;
    }
</style>

<body>
    <table border="0" align="center" cellspacing="0" cellpadding="0" class="email-container">
        <tr>
            <td>
                <table border="0" cellspacing="0" cellpadding="0" style="color:#0f3462;">
                    <!-- Email Header with Logo -->
                    {{-- <tr>
                        <td class="email-header">
                            <img src="{{ $logo }}" alt="Company Logo" style="max-width: 200px; height: auto;">
                        </td>
                    </tr> --}}

                    <!-- English Section -->
                    <tr>
                        <td class="email-content">
                            <h2 style="font-weight: 900; text-align: center;">
                                Subscription for {{ $service_name }}
                            </h2>
                            <h3>Dear {{ $customer_name ?? '' }},</h3>
                            <p>
                                {{ $company ?? '' }} sincerely appreciates the trust you’ve placed in us. This email is to confirm that we have successfully activated the {{ $service_name ?? '' }} for your business.
                            </p>
                            <p>
                                We are excited to provide you with the best of our services and dedicated technical support, ensuring your business thrives with our solutions.
                            </p>

                            <!-- Responsive Table -->
                            <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
                                <thead>
                                    <tr style="background-color: #190093; color: white; text-align: left;">
                                        <th style="padding: 10px; border: 1px solid #ddd;">Details</th>
                                        <th style="padding: 10px; border: 1px solid #ddd;">Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="background-color: #f9f9f9;">
                                        <td style="padding: 10px; border: 1px solid #ddd;">Service Name</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $service_name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">Purchase Date</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $purchase_date ?? '' }}</td>
                                    </tr>
                                    <tr style="background-color: #f9f9f9;">
                                        <td style="padding: 10px; border: 1px solid #ddd;">Renewal Date</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $renewl_date ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">Renewal Cost</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $renewl_cost ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <p>
                                Thank you, <br>
                                <strong>{{ $company ?? '' }}</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Arabic Section -->
                    <tr>
                        <td class="email-content" style="direction: rtl; text-align: right;">
                            <h2 style="font-weight: 900; text-align: center;">
                                تأكيد الاشتراك في {{ $service_name }}
                            </h2>
                            <h3>عزيزي {{ $customer_name ?? '' }}</h3>
                            <p>
                                {{ $company ?? '' }} يشكركم جزيل الشكر على ثقتكم الغالية في خدماتنا. نؤكد لكم أنه تم تفعيل خدمة {{ $service_name ?? '' }} لعملكم بنجاح.
                            </p>
                            <p>
                                نحن متحمسون لتقديم أفضل خدماتنا ودعمنا الفني المتميز لضمان نجاح عملكم مع حلولنا التقنية.
                            </p>

                            <!-- Responsive Table -->
                            <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
                                <thead>
                                    <tr style="background-color: #190093; color: white; text-align: right;">
                                        <th style="padding: 10px; border: 1px solid #ddd;">التفاصيل</th>
                                        <th style="padding: 10px; border: 1px solid #ddd;">المعلومات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="background-color: #f9f9f9;">
                                        <td style="padding: 10px; border: 1px solid #ddd;">اسم الخدمة</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $service_name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">تاريخ الشراء</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $purchase_date ?? '' }}</td>
                                    </tr>
                                    <tr style="background-color: #f9f9f9;">
                                        <td style="padding: 10px; border: 1px solid #ddd;">تاريخ التجديد</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $renewl_date ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">تكلفة التجديد</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $renewl_cost ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <p>
                                شكرًا لكم، <br>
                                <strong>{{ $company ?? '' }}</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer" style="text-align: center;">
                            <p>&copy; {{ date('Y') }} {{ $company ?? '' }}. جميع الحقوق محفوظة.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>


</html>
