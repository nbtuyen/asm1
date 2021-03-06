<!DOCTYPE html>
<html>
<title>Đăng nhập</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    .mySlides {
        display: none
    }

    #container-login {
        display: flex;
        flex-direction: row;
        width: 1503.2px;
        height: auto;
        margin: 10px auto;
        background-color: #999999;
    }

    .boxleft {
        width: 60%;
        margin-left: 30px;
    }

    .boxright {
        width: 35%;
        margin-right: 30px;
    }

    /* form */
    .form {
        width: 406px;
        max-width: 406px;
        margin: 0 auto;
        margin-left: 100px;
        margin-top: 190px;
    }

    #signup {
        padding: 0px 25px 25px;
        background: #fff;
        box-shadow:
            0px 0px 0px 5px rgba(255, 255, 255, 0.4),
            0px 4px 20px rgba(0, 0, 0, 0.33);
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        display: table;
        position: static;
    }

    #signup .header {
        margin-bottom: 20px;
    }

    #signup .header h3 {
        color: #333333;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    #signup .header p {
        color: #8f8f8f;
        font-size: 14px;
        font-weight: 300;
    }

    #signup .sep {
        height: 1px;
        background: #e8e8e8;
        width: 406px;
        margin: 0px -25px;
    }

    #signup .inputs {
        margin-top: 25px;
    }

    #signup .inputs label {
        color: #8f8f8f;
        font-size: 12px;
        font-weight: 300;
        letter-spacing: 1px;
        margin-bottom: 7px;
        display: block;
    }

    input::-webkit-input-placeholder {
        color: #b5b5b5;
    }

    input:-moz-placeholder {
        color: #b5b5b5;
    }

    #signup .inputs input[type=email],
    input[type=password] {
        background: #f5f5f5;
        font-size: 0.8rem;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        border: none;
        padding: 13px 10px;
        width: 356px;

        box-shadow: inset 0px 2px 3px rgba(0, 0, 0, 0.1);
        clear: both;
    }

    .IPemail {
        height: 75px;
    }

    .IPname {
        height: 75px;
    }

    .IPpass {
        height: 75px;
    }

    #signup .inputs input[type=email]:focus,
    input[type=password]:focus {
        background: #fff;
        box-shadow: 0px 0px 0px 3px #fff38e, inset 0px 2px 3px rgba(0, 0, 0, 0.2), 0px 5px 5px rgba(0, 0, 0, 0.15);
        outline: none;
    }

    #signup .inputs .checkboxy {
        display: block;
        position: static;
        height: 25px;
        margin-top: 10px;
        clear: both;
    }

    #signup .inputs input[type=checkbox] {
        float: left;
        margin-right: 10px;
        margin-top: 3px;
    }

    #signup .inputs label.terms {
        float: left;
        font-size: 14px;
        font-style: italic;
    }

    #signup .inputs #submit {
        width: 100%;
        margin-top: 20px;
        padding: 15px 0;
        color: #fff;
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 1px;
        text-align: center;
        text-decoration: none;
        background: -moz-linear-gradient(top,
                #b9c5dd 0%,
                #a4b0cb);
        background: -webkit-gradient(linear, left top, left bottom,
                from(#b9c5dd),
                to(#a4b0cb));
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        border: 1px solid #737b8d;
        -moz-box-shadow:
            0px 5px 5px rgba(000, 000, 000, 0.1),
            inset 0px 1px 0px rgba(255, 255, 255, 0.5);
        -webkit-box-shadow:
            0px 5px 5px rgba(000, 000, 000, 0.1),
            inset 0px 1px 0px rgba(255, 255, 255, 0.5);
        box-shadow:
            0px 5px 5px rgba(000, 000, 000, 0.1),
            inset 0px 1px 0px rgba(255, 255, 255, 0.5);
        text-shadow:
            0px 1px 3px rgba(000, 000, 000, 0.3),
            0px 0px 0px rgba(255, 255, 255, 0);
        display: table;
        position: static;
        clear: both;
    }

    #signup .inputs #submit:hover {
        background: -moz-linear-gradient(top,
                #a4b0cb 0%,
                #b9c5dd);
        background: -webkit-gradient(linear, left top, left bottom,
                from(#a4b0cb),
                to(#b9c5dd));
    }

    span {
        margin-top: 10px;
        min-height: 20px;
    }
</style>

<body>

    <div id="container-login">
        <div class="boxleft">
            <div class="w3-container">
                <h2>Slideshow Indicators</h2>
                <p>An example of using buttons to indicate how many slides there are in the slideshow, and which slide the user is currently viewing.</p>
            </div>

            <div class="w3-content" style="width:100%">
                <div class="mySlides" style="width:100%;height:500px"><img src="{{ IMG_URL . 'banner3.jpg' }}" alt="" style="width:100%"></div>
                <div class="mySlides" style="width:100%;height:500px"><img src="{{ IMG_URL . 'banner1.png' }}" alt="" style="width:100%"></div>
                <div class="mySlides" style="width:100%;height:500px"><img src="{{ IMG_URL . 'banner2.png' }}" alt="" style="width:100%"></div>
            </div>

            <div class="w3-center">
                <div class="w3-section">
                    <button class="w3-button w3-light-grey" onclick="plusDivs(-1)">❮ Prev</button>
                    <button class="w3-button w3-light-grey" onclick="plusDivs(1)">Next ❯</button>
                </div>
                <button class="w3-button demo" onclick="currentDiv(1)">1</button>
                <button class="w3-button demo" onclick="currentDiv(2)">2</button>
                <button class="w3-button demo" onclick="currentDiv(3)">3</button>
            </div>
        </div>

        <div class="boxright">
            <div class="form">
                <form id="signup" action="" method="post">
                    <div class="header">
                        <h3>Sign Up</h3>
                        <p>You want to fill out this form</p>
                    </div>
                    <div class="sep"></div>
                    <div class="inputs">
                        <div class="IPemail"><input type="email" name="email" id="email" placeholder=" e-mail" autofocus />
                            <span id="emailSpan" style="color:red"></span>
                        </div>
                        <div class="IPpass">
                            <input type="password" name="password" id="password" placeholder="Password" />
                            <span id="passSpan" style="color:red"></span>
                        </div>
                        <div class="checkboxy">
                            <label class="terms">Chưa có tài khoản</label><a href="{{ BASE_URL . 'tai-khoan/dang-ki' }}" style="text-decoration: none;font-style: italic;">Đăng Kí</a>
                        </div>
                        <button type="submit" id="submit">Đăng Nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var email = document.querySelector("#email");
        var valEmail = document.querySelector("#emailSpan");
        var pass = document.querySelector("#password");
        var valPass = document.querySelector("#passSpan");
        var btn = document.querySelector("#submit");
        email.onblur = function() {
            var val1 = this.value;
            var pattern1 = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var check1 = pattern1.test(val1);
            if (!check1) {
                valEmail.innerText = "Bạn nhập ko đúng email.";
            } else {
                valEmail.innerText = "";
            }

        }
        pass.onblur = function() {
            var val4 = this.value;
            if (val4 === "") {
                valPass.innerText = "Nhập mật khẩu";
            } else {
                valPass.innerText = "";
            }
        }
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function currentDiv(n) {
            showDivs(slideIndex = n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" w3-red", "");
            }
            x[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " w3-red";
        }
    </script>

</body>

</html>