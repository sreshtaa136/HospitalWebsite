<?php
$pageTitle = "Russel Street Medical";
require_once("php/tools.php");
require_once("segments/head.php");
require_once("segments/header.php");
require_once("segments/nav.php");
?>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="4"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                
                <!-- Image taken from  https://img.freepik.com/free-photo/my-daughter-isn-t-afraid-pay-visit-here_329181-7634.jpg?w=2000&t=st=1665490860~exp=1665491460~hmac=4afbe3964f513d4e49305ecc64fc69278e54b4cc3a0cc6578db150ea42a3b55c -->
                <div class="item active">
                    <img src="images/highfive.png" 
                    alt="young female doctor in white medical uniform high-fiving a girl who is sitting on her mother's lap">
                </div>

                <!-- Image taken from https://img.freepik.com/free-photo/asian-medical-assistant-consulting-male-patient-medical-clinic-reception-sitting-waiting-room-lobby-young-man-nurse-discussing-about-healthcare-consultation-diagnosis_482257-48903.jpg?w=2000&t=st=1665492531~exp=1665493131~hmac=0d83d15da9035325fb988245e0f6c5a435231ea08db612111d578aa218d3c868 -->
                <div class="item">
                    <img src="images/consulting.png" 
                    alt="female medical assistant consulting male patient in the clinic waiting room">
                </div>
                
                <!-- Image taken from https://img.freepik.com/free-photo/young-asia-female-doctor-white-medical-uniform-using-clipboard-is-delivering-great-news-talk-discuss-results_7861-3135.jpg?w=2000&t=st=1665491024~exp=1665491624~hmac=dbd4e89eca160de1236ce4919c6495d53a8a214db12882b3bd48180686e49985 -->
                <div class="item">
                    <img src="images/explaining_results.png" 
                    alt="young female doctor in white medical uniform using a clipboard to discuss results">
                </div>
                
                <!-- Image taken from https://img.freepik.com/free-photo/doctor-stick-bandaid-girl-s-shoulder-after-vaccination_1157-52103.jpg?w=2000&t=st=1665490835~exp=1665491435~hmac=521f1530666ac97dac7f1c182227344d5fa882c7d3374fdb40d7dbf09983a293 -->
                <div class="item">
                    <img src="images/bandaid.png" 
                    alt="doctor sticking bandaid on a girl's shoulder after vaccination">
                </div>
                
                <!-- Image taken from https://www.rsmc.net.au/wp-content/uploads/2020/07/slide5-1500x430.jpg -->
                <div class="item">
                    <img src="images/staff.png" 
                    alt="RMSC staff standing in a line facing the camera and smiling">
                </div>
            </div>
    
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <main>
            <section class="about-us" id="about-us">
                <div class="text-area">
                    <h1><b>About Us</b></h1>
                    <p>Russel Street Medical opened in 2020 and is located in Melbourne’s 
                    CBD at 340 Russel Street Melbourne,<br>just opposite The Old Melbourne Jail and within walking distance of Melbourne Central Train Station.
                    <br><br>We strive to help all of our patients with a focus on preventative health care, a view to managing chronic<br>health conditions with a 
                    holistic approach, and with access to a wide range of specialist care providers<br> 
                    when needed. Under partnerships, we are able to offer RMIT students & staff discounted rates.<br><br>
                    <b>Opening timings: Mon - Sun, 9am - 6pm</b>
                    </p>
                    <button type="button" class="fee-details-collapsible" id="fee-details-collapsible" onclick="collapsibleFee()">Fee details</button>
                    <div class="fee-details">
                        <table>
                            <tr>
                                <th>Consultation</th>
                                <th>Normal Fee</th>
                                <th>Member Fee</th>
                                <th>Medicare Rebate</th>
                            </tr>
                            <tr>
                                <td>Standard</td>
                                <td>$85.00</td>
                                <td>$60.50</td>
                                <td>$39.75</td>
                            </tr>
                            <tr>
                                <td>Long or Complex</td>
                                <td>$130.00</td>
                                <td>$91.00</td>
                                <td>$76.95</td>
                            </tr>
                        </table>
                    </div>
                </div>     
                <!-- image taken from https://www.rsmc.net.au/wp-content/uploads/2020/07/MG_1386.jpg -->         
                <img src="https://www.rsmc.net.au/wp-content/uploads/2020/07/MG_1386.jpg" 
                alt="Russel Street Medical's receptionist sitting at her desk and smiling while talking to a customer">               
            </section>

            <section class="who-we-are" id="who-we-are">
                <h1><b>Who we are</b></h1>
                <div class="card">
                    <!-- image taken from https://www.pexels.com/photo/a-woman-in-white-long-sleeve-shirt-holding-a-red-stethoscope-9062164/ -->
                    <img src="images/pexels-alexander-zvir-9062164.jpeg" 
                    alt="Dr. Abigale Laurentis in white long sleeve shirt holding a red stethoscope">
                    <div class="card-content">
                        <h2>Dr. Abigale Laurentis</h2>
                        <p>Abigale Laurentis completed her medical degree at the University of Queensland in 2013,<br> 
                        where she also obtained a Bachelor of Science in Biomedicine.<br>Over her training and practice, 
                        Abigale has worked in a variety of clinical settings including<br>specialities at Latrobe Health.</p>
                    </div>
                </div>
                <div class="card">
                    <!-- image taken from https://www.pexels.com/photo/a-man-wearing-a-stethoscope-on-his-neck-6234600/ -->
                    <img src="images/pexels-tima-miroshnichenko-6234600.jpeg" 
                    alt="Dr. Stephen Hill wearing a stethoscope on his neck">
                    <div class="card-content">
                        <h2>Dr. Stephen Hill</h2>
                        <p>Stephen Hill graduated from Auckland University in New Zealand in 2014, and obtained his<br> 
                        Fellowship from the Royal Australian College of General Practitioners in 2017.<br>Over his training 
                        and practice, Stephen worked in internal medicine at the Royal Children's Hospital<br>Melbourne before 
                        transitioning to General Practice.</p>
                    </div>
                </div>
                <div class="card">
                    <!-- image taken from https://www.pexels.com/photo/female-medical-practitioner-wearing-laboratory-coat-8442283/ -->
                    <img src="images/pexels-pavel-danilyuk-8442283.jpeg" 
                    alt="Nurse Kiyoko Tsu wearing a laboratory coat">
                    <div class="card-content">
                        <h2>Ms Kiyoko Tsu</h2>
                        <p>Kiyoko Tsu completed her Bachelor of Nursing at the Yong Loo Lin School of Medicine in Singapore in 2019. 
                        <br>She is an accredited Nurse Immuniser and has worked in various hospitals within metropolitan Melbourne.</p>
                    </div>
                </div>
            </section>

            <section class="service-area" id="service-area">
                <h1><b>New Here?</b></h1>
                <p>You can register with us in person first and then continue to book vaccinations and blood tests 
                    on our online booking system!</p><br>
                <h2><b>Already registered?</b></h2>
                <p>Go ahead and select the 'bookings' button on the menu bar on top of the page! 
                    You can book your vaccinations and blood tests using our online booking system.</p>
            </section>
        </main>
<?php require_once("segments/footer.php"); ?>