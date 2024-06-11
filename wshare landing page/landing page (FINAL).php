<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>Wshare</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
        <link href="landing page (FINAL).css" rel="stylesheet">

        <style>
            *{
                margin:0;
                padding:0;
                /*@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
                */font-family: inter;
            }
            body {
                overflow-x: hidden;
            }

            .navbar{
                position: fixed;

                width: 100%;
                height: 100px;

                background: transparent;
                /*background: #bb2525;*/

                
            }

            .logo{
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                font-size:xx-large;
                margin: 30px;
                float: left;
                color:#f0f1f1;
            }

            .navbar ul{

                display: flex;
                justify-content: right;

                list-style: none;
            }

            .navbar ul li{

                padding-top: 10px;
                padding-bottom: 10px;
                padding-left:20px;
                padding-right:20px;

                margin-left: 20px;
                margin-right: 20px;
                margin-top:30px;
                margin-bottom: 30px;


                border: 1px solid #f0f1f1;
                border-radius: 25px;
                cursor: pointer;
                transition: 0.4s ease;
            }

            .navbar ul li a{
                text-decoration: none;
                color: #f0f1f1;
                
            }

            .navbar ul li:hover{
                padding: 10px;
                border: 1px solid #191970;
                background-color: #191970;
                a{
                    color: #f0f1f1;
                }
            }


            .container{
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            .section1{

                display: flex;
                flex-wrap: wrap;
                justify-content: center;



                height: 100vh;
                width:100vw;
                /*background-image: linear-gradient(to right, #141e46, rgba(0,0,0,0.5)), url('students.png') ;*/
                background: linear-gradient(to top, #141e46, rgba(0,0,0,0.5)), url('students.png');
                background-size: cover;

            }

            .container_sec1{
                display: flex;
                padding-top: 200px;
                margin: 150px;
                

                
                justify-content: left;
            }

            h1{

                width: 500px;
                color: #f0f1f1;
                height: 100px;
            }


            p{
                margin-top: 20px;

                font-size: large;
                color: #f0f1f1;

                word-spacing: 2px;
                text-align: justify;
                width: 800px;
            }

            .about{
                display: flex;
                flex-wrap: wrap;
                justify-content: center;

                width: 100vw;
                height: 150px;
                background-color: #141e46;
            }

            .abt_header{
                align-self: center;
                margin: 50px;
            }

            h2{
                text-align:center;
                width:100vw;
                color: #f0f1f1;
            }


            .section2{
                display: flex;

                height: 100%;
                width: 100vw;

                background: linear-gradient(to bottom, #141e46, rgba(0,0,0,0.5)), url('net.png');
                background: linear-gradient(to bottom, #141e46, #191970);
            
                background-size: cover;
            }

            .description_con{
                display: flex;
                padding-top: 100px;
                margin-left: 150px;
                margin-top: 150px;
                margin-bottom: 150px;
                margin-right: 50px;
                
                height: 100vh;
                width: 480px;

            }

            .description_con2{
                display: flex;
                padding-top: 100px;
                margin-left: 50px;
                margin-top: 150px;
                margin-bottom: 150px;
                margin-right: 30px;

                width: 480px;

            }

            .description_con3{
                display: flex;
                padding-top: 100px;
                margin-left: 50px;
                margin-top: 150px;
                margin-bottom: 150px;
                margin-right: 30px;

                width: 480px;

            }

            .image{
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                margin: 20px;
                background-color: #141e46;
                height: 300px;
                width: 300px;

                border-radius: 50px;

                box-shadow: 0 2px 2px 3px black;
            }

            img{
                
                border-radius: 150px;
                height: 300px;
                width: 300px;
            }

            .feature{
                align-items: center;
                width: 100%;
            }

            .feature_desc{
                margin-top: 50px;
                margin-left: 20px;
                margin-right: 20px;
                margin-bottom: 20px;

                font-size: large;
                color: #f0f1f1;

                text-align: center;
                width: 100%;
            }

            .about2{
                padding-top: 300px;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;

                width: 100%;
                height: 150px;
                background-color:#191970;
            }

            .abt_header{
                align-self: center;
                margin: 50px;
            }

            .section3{
                justify-content: center;

                height: 100vh;
                width: 100%;
                background: linear-gradient(to bottom, #191970, #141e46);
                
            }

            .inv{
                height: 50px;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                text-align: center;
            }

            .p_inv{
                font-size: larger;
                text-align: center;
                width: 100%;
            }

            button{
                background-color: #007bff;
                color: #f0f1f1;
                font-weight: bold;
                outline: none;
                border: none;
                margin: 30px;
                height: 50px;
                width: 200px;

            }

            button:hover{
                height: 70px;
                width: 240px;

                transition: 0.4s ease;
            }

            .footer{
                height: 100%;
                width: 100%;
                background: linear-gradient(to bottom, #191970, #141e46);
            }

            .footer ul{
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .footer ul li{
                margin-bottom: 100px;
                margin-top: 20px;
                margin-left: 20px;
                margin-right: 20px;


                text-align: center;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left:20px;
                padding-right:20px;

                transition: 0.4s ease;
            }

            .footer ul li a{
                text-decoration: none;
                color: #f0f1f1;
            }

            .footer ul li:hover{
                background: linear-gradient(to bottom, #007bff, #141e46);
                transition: 0.4s ease;
            }

            @media screen and (max-width: 758px) {

                .navbar{
                    width: 100vw;
                }
                .navbar ul li a{

                    font-size: small;
                }
                
                .navbar ul li{
                    padding-top: 10px;
                    padding-bottom: 10px;
                    padding-left:10px;
                    padding-right:10px;

                    margin-left: 10px;
                    margin-right: 10px;
                    margin-top:30px;
                    margin-bottom: 30px;
                }

                .section1{
                    width: 100vw;
                }

                .container_sec1 {
                    padding-top: 50px;
                    width: 90%;
                    justify-content: center;
                }

                h1 {
                    width: 90%;
                    text-align: center;
                    padding: 0;
                    transition: 0.1s ease;
                }

                h2{
                    margin: 10;
                    text-align: center;

                    transition: 0.1s ease;
                }

                p{ 
                    align-self: center;
                    margin: 10px;
                    font-size: small;
                    width: 350px;

                    transition: 0.4s ease;
                }

                .text{
                    margin: none;
                    font-size: smaller;
                    width: 350px;

                    transition: 0.4s ease;
                }

                .section2{
                    height: 100%;
                    flex-direction: column;
                    align-items: center;

                }

                .description_con {
                    padding-top: 25px;
                    margin: 0 auto;
                    max-width: 90%;
                    transition: 0.4s ease;
                }

                .image{
                    align-self: center;
                    margin: 20px;
                    background-color: #141e46;
                    height: 200px;
                    width: 200px;

                    border-radius: 50px;
                }

                img{
                    
                    border-radius: 150px;
                    height: 200px;
                    width: 200px;
                }

                .feature{
                    align-items: center;
                    width: 100%;
                }

                .feature_desc{
                    margin-top: 50px;
                    
                    margin-bottom: 20px;

                    font-size: large;
                    color: #f0f1f1;
                    
                    text-align: justify;
                    width: 90%;
                }
                    
                .about{
                    display: flex;
                    flex-wrap: wrap;
                    
                }

                .abt_header{
                    font-size:medium;
                }

                .about2{
                    padding-top: 500px;
                }

                .footer ul{
                    flex-direction: column;
                }

                .footer ul li{
                    margin: 10px;
                    text-align: left;
                }
            }
        </style>
    </head>

    <body>

        <div class="navbar">

            <div class="logo">Wshare</div>

            <ul>
                <li><a href = "../wshare system/login.php">LOGIN</a>
                <li class="signup"><a href = "../wshare system/signup.php">SIGNUP</a>
            </ul>
        </div>

            <div class="container">

                <div class="section1">

                    <div class="container_sec1">

                        <div class="text">
                            <h1>WELCOME TO Wshare!</h1>
                            <p>Empowering WMSU Students to thrive through collaboration and knowledge exchange, this forum platform is your gateway to a vibrant community of learning and growth.</p>
                        </div>

                    </div>

                </div>

                <div class="about">
                    <div class="abt_header">
                        <h2>ABOUT THE PLATFORM</h2>
                    </div>
                </div>

                <div class="section2">

                    <div class="description_con">
                        <div class="image"><img src="groupofpeople.png">
                            <p class = "feature_desc"><strong><i>Join discussions within the wmsu community</i></strong> to connect with peers, create comprehensive user profiles showcasing your interests, and embark on collaborative discussions to build your knowledge and network.</p>
                        </div>
                        <!--<div class="feature"></div>-->
                    </div>

                    <div class="description_con">
                        <div class="image"><img src="men.png">
                            <p class = "feature_desc">At the heart of the platform lies a <strong><i>vibrant community forum</strong></i>, where students come together to share experiences, navigate academic challenges, and chart their career paths.</p>
                        </div>
                        <!--<div class="feature"></div>-->
                    </div>
                    
                    <div class="description_con">
                        <div class="image"><img src="peopleladder.png">
                            <p class = "feature_desc">Experience the power of collaboration, share interesting stories, and embark on a journey of <strong><i>lifelong learning with the WMSU Student Skill Sharing Platform.</strong></i></p>
                        </div>
                        <!--<div class="feature"></div>-->
                    </div>

                </div>

                <div class="about2">
                    <div class="abt_header">
                        <h2>SOUNDS FUN!</h2>
                    </div>
                </div>

                <div class="section3">
                    <div class="inv">
                        <p class = "p_inv">Sign up now and be part of a community dedicated to your success.</p>
                        <button><a href = "../wshare system/index.php" style = "color: #f0f1f1; text-decoration:none;">Let's Get Started</a></button>
                    </div>
                </div>

                <div class="footer">
                    <ul>
                        <li><a href = "#">ABOUT</a></li>
                        <li><a href = "#">CONTACT</a></li>
                        <li><a href = "#">PRIVACY POLICY</a></li>
                        <li><a href = "#">TERMS OF USE</a></li>
                        <li><a href = "#">FAQ</a></li>
                        <li><a href = "#">SUPPORT</a></li>
                    </ul>
                </div>
        </div>

        <!--<script src="landing page (FINAL).js"></script>-->
    </body>
</html>