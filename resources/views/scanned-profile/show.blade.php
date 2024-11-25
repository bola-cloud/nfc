<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->user->name }}'s Profile</title>
    <!-- Include Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>

    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
    rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
    rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >

    <style>
        body {
            background-color: #1c1c1c;
            color: #ffffff;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .dark-color{
            background-color: #1c1c1c !important;
            color: white;
        }

        .profile-container {
            max-width: 400px;
            margin: 0 auto;
        }

        .profile-image-container {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            padding: 5px;
            margin: 0 auto 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-name {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }

        .social-icons a {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            text-decoration: none;
            font-size: 20px;
            background: #333;
            border-radius: 50%;
            transition: transform 0.2s, background 0.2s;
        }

        .social-icons a:hover {
            transform: scale(1.1);
            background: #555;
        }

        .profile-info {
            margin-top: 20px;
            text-align: left;
        }

        .line {
            display: block;
            white-space: pre;
            overflow: hidden;
            border-right: 2px solid #ffffff;
            animation: typing 3s steps(40, end), blink 0.5s step-end infinite;
            margin: 10px 0;
        }

        /* Typing effect animation */
        @keyframes typing {
            from {
                width: 0;
            }
            to {
                width: 100%;
            }
        }

        @keyframes blink {
            from, to {
                border-color: transparent;
            }
            50% {
                border-color: white;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card dark-color">
            <div class="profile-container">
                <!-- Profile Image with Instagram Border -->
                <div class="profile-image-container">
                    <img src="{{ $profile->profile_image_url ?? 'default-image.jpg' }}" alt="Profile Image" class="profile-image">
                </div>

                <!-- Name -->
                <div class="profile-name">{{ $profile->user->name }}</div>

                <!-- Social Media Icons -->
                <div class="social-icons">
                    <a href="https://twitter.com/{{ $profile->twitter ?? '#' }}" target="_blank">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="https://facebook.com/{{ $profile->facebook ?? '#' }}" target="_blank">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                    <a href="https://instagram.com/{{ $profile->instagram ?? '#' }}" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://linkedin.com/in/{{ $profile->linkedin ?? '#' }}" target="_blank">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="https://skype.com/{{ $profile->skype ?? '#' }}" target="_blank">
                        <i class="fab fa-skype"></i>
                    </a>
                </div>

                <!-- Profile Information with Typing Animation -->
                <div class="profile-info">
                    <span class="line"><strong>Bio:</strong> {{ $profile->bio }}</span>
                    <span class="line"><strong>Website:</strong> <a href="{{ $profile->website }}" target="_blank" style="color: #ffffff;">{{ $profile->website }}</a></span>
                    <span class="line"><strong>Company:</strong> {{ $profile->company }}</span>
                    <span class="line"><strong>Job Title:</strong> {{ $profile->job_title }}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>