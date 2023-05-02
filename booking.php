<?php
$pageTitle = "Booking";
require_once("php/tools.php");
require_once("segments/head.php");
require_once("segments/header.php");
require_once("segments/nav.php");
?>
        <main>
            <section class="booking-form">
                <h1><b>Book an Appointment</b></h1>
                <span id="form-success"><?php echo $formSuccess; ?></span>
                <li id="home-link"><a href="index.php"><?php echo $homeLink; ?></a></li>              
                <form method="post" action="booking.php">
                    <div class="row">
                        <div class="col-25">
                            <label>Your Patient Id: </label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="pid" name="pid" value="<?php echo $pidInput; ?>" onkeyup="capitalise()" onfocusout="pidCheck()" required>                          
                        </div>
                        <div class="col-75">
                            <span id="form-error"><?php echo $pidError; ?></span>
                            <span id="pidError"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-25">
                            <label>Select an appointment date: </label>
                        </div>
                        <div class="col-75">
                            <input type="date" id="date" name="date" value="<?php echo $dateInput; ?>" min="<?php echo date('Y-m-d'); ?>" onclick="setMinDate()" required>
                            <span id="form-error"><?php echo $dateError; ?></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-25">
                            <label class="pill-label">Select an appointment time: </label>
                        </div>
                        <div class="col-75">
                            <div class="pill-container">
                                <div class="pill" id="pill-1">
                                    <label>
                                        <input type="checkbox" name="time[]" value="9am-12pm" <?php if(in_array('9am-12pm', $timeArray)) echo 'checked'; ?> ><span>9am - 12pm</span>
                                    </label>
                                </div>
                                <div class="pill" id="pill-2">
                                    <label>
                                        <input type="checkbox" name="time[]" value="12pm-3pm" <?php if(in_array('12pm-3pm', $timeArray)) echo 'checked'; ?>><span>12pm - 3pm</span>
                                    </label>
                                </div>
                                <div class="pill" id="pill-3">
                                    <label>
                                        <input type="checkbox" name="time[]" value="3pm-6pm" <?php if(in_array('3pm-6pm', $timeArray)) echo 'checked'; ?>><span>3pm - 6pm</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <span id="form-error"><?php echo $timeError; ?></span>                        
                    </div>
                    
                    <div class="row">
                        <div class="col-25">
                            <label>Select the reason for your appointment: </label>
                        </div>
                        <div class="col-75">
                            <select name="reason" id="reason" value="" oninput="printAdvice()" required>
                                <option value="">Please Select</option>
                                <option value="ChildhoodVaccinationShots" <?php if(!$check and isset($_POST['reason']) and ($_POST['reason']=="ChildhoodVaccinationShots")){echo 'selected';} ?> >Childhood Vaccination Shots</option>
                                <option value="InfluenzaShot" <?php if(!$check and isset($_POST['reason']) and ($_POST['reason']=="InfluenzaShot")){echo 'selected';} ?> >Influenza Shot</option>
                                <option value="CovidBoosterShot" <?php if(!$check and isset($_POST['reason']) and ($_POST['reason']=="CovidBoosterShot")){echo 'selected';} ?> >Covid Booster Shot</option>
                                <option value="BloodTest" <?php if(!$check and isset($_POST['reason']) and ($_POST['reason']=="BloodTest")){echo 'selected';} ?> >Blood Test</option>
                            </select>
                            <span id="form-error"><?php echo $reasonError; ?></span>                              
                        </div>
                        <div class="col-75">
                            <div class="advice-container">
                                <span id="advice"></span><?php echo $advice; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <button type="submit" class="submit" onclick="checkTime(event)">Submit</button>
                        <button class="submit" formnovalidate>Submit without validation</button>
                    </div>
                </form> 
            </section>
        </main>
<?php require_once("segments/footer.php"); ?>