<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Registration Portal</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;

            background:
                linear-gradient(
                    135deg,
                    #f5fdf5 0%,
                    #e8f5e9 100%
                );

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 20px;
        }

        .hero-container {
            width: 100%;
            max-width: 800px;
        }

        .hero-card {
            background: rgba(255,255,255,0.96);
            backdrop-filter: blur(10px);

            border-radius: 24px;

            padding: 50px;

            text-align: center;

            box-shadow:
                0 15px 35px rgba(0,0,0,0.08);

            border: 1px solid rgba(76,175,80,.15);
        }

        h1 {
            color: #2e7d32;
            margin-bottom: 20px;
            font-size: 2.5rem;
        }

        .subtitle {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.7;
            margin-bottom: 40px;
        }

        .button-grid {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            color: white;

            padding: 18px 35px;

            border-radius: 12px;

            font-weight: 600;

            transition: all .25s ease;

            min-width: 260px;

            display: inline-block;
        }

        .btn-volunteer {
            background: #43a047;
        }

        .btn-volunteer:hover {
            background: #2e7d32;
            transform: translateY(-3px);
        }

        .btn-admin {
            background: #1565c0;
        }

        .btn-admin:hover {
            background: #0d47a1;
            transform: translateY(-3px);
        }

        .footer {
            margin-top: 40px;
            color: #777;
            font-size: 0.95rem;
        }

        @media (max-width: 768px)
        {
            .hero-card {
                padding: 35px 25px;
            }

            h1 {
                font-size: 2rem;
            }

            .btn {
                width: 100%;
            }
        }

    </style>
</head>
<body>

<div class="hero-container">

    <div class="hero-card">

        <h1>🌱 Volunteer Registration Portal</h1>

        <p class="subtitle">
            Thank you for your interest in supporting our environmental initiatives.
            Volunteers play an important role in helping our programs succeed.
            Please complete the volunteer application form to get started.
        </p>

        <div class="button-grid">

            <a class="btn btn-volunteer"
               href="volunteer_form.php">
                Complete Volunteer Form
            </a>

            <a class="btn btn-admin"
               href="admin_login.php">
                Administrator Login
            </a>

        </div>

        <div class="footer">
            Building a greener future together.
        </div>

    </div>

</div>

</body>
</html>
