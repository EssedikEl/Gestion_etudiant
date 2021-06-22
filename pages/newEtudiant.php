<?php
    require_once('identifier.php');
    $date = getdate();
    $AnneeCourante = $date['year'];
    if($date['mon']==9 || $date['mon']==10 || $date['mon']==11 || $date['mon']==12){
        $anneeScolairePart1=$AnneeCourante;
        $anneeScolairePart2= $AnneeCourante+1;
    }
    else{
        $anneeScolairePart1=$AnneeCourante-1;
        $anneeScolairePart2= $AnneeCourante;
    }
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Page Blanche</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <script src="../js/jquery-3.3.1.js"></script>
        <script src="../js/moment.min.js"></script>
        <script src="../js/bootstrap-datetimepicker.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include("menu.php");?>
        <div class="container">
            <div class="panel panel-primary margetop">
                <div class="panel-heading">Veuillez Saisir les informations suivantes:</div>
                <div class="panel-body">
                   <!-- MultiStep Form -->
                   <form id="regForm" action="addEtudiant.php" method="post" class="form" enctype="multipart/form-data">

                    <h1>S'inscrire:</h1>

                    <!-- One "tab" for each step in the form: -->
                    <div class="tab"><h3>Etudiant Info:</h3>
                        <div class="form-group">
                            <label>Nom :</label>
                            <input type="text" name="nomEtudiant" placeholder="Taper le nom" class="form-control" required='required'/>
                        </div>
                        <div class="form-group">
                            <label>Prénom :</label>
                            <input type="text" name="prenomEtudiant" placeholder="Taper le prénom" class="form-control"required='required'/>
                        </div>
                        <div class="form-group">
                            <label>Date de naissance :</label>
                            <div class='input-group date' id='datetimepicker' required='required'>
                                <input type='text' class="form-control" name="dateNaissance"/>
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Lieu de naissance:</label>
                            <input type="text" name="lieuN" placeholder="Taper le lieu de Naissance..." class="form-control" required='required'/>
                        </div>
                        <div class="form-group">
                            <label>Adresse :</label>
                            <input type="text" name="adresse" placeholder="Taper l'adresse..." class="form-control" required='required'/>
                        </div>
                        <div class="form-group">
                            <label>Email :</label>
                            <input type="text" name="mail" placeholder="Taper l'email..." class="form-control" required='required'/>
                        </div>
                        <div class="form-group">
                            <label>Tel :</label>
                            <input type="text" name="phone" placeholder="Taper le numéro de Tel..." class="form-control" required='required'/>
                        </div>
                        <div class="form-group">
                            <div class="radio-inline">
                                <input type="radio" name="civiliteRadio" value="M" checked>
                                <label>Masculin</label>
                            </div>
                            <div class="radio-inline">
                                <input type="radio" name="civiliteRadio" value="F">
                                <label>Féminin</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="niveau">Niveau :</label>
                            <select name="niveau" class="form-control" required='required' id="niveau" >
                                <option value='1' selected>1ère année</option>
                                <option value='2'>2ème année</option>
                                <option value='3'>3ème année</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Photo :</label>
                            <div class='input-group'>
                                <input type="file" name="photo" id="photo" accept=".jpg, .png, .jpeg, .gif"
                                class="form-control" required='required'/>
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group col-sm-4">
                                <div class="input-group-addon">
                                    <span class="input-group-text" required='required' id="">Année scolaire :</span>
                                </div>
                                <input type="text" name="anneeScolairePart1" class="form-control" value = "<?php echo $anneeScolairePart1 ?>"/>
                                <span class="input-group-btn" style="width:0px;"></span>
                                <input type="text" name="anneeScolairePart2" class="form-control" value = "<?php echo $anneeScolairePart2 ?>"/>
                            </div>
                        </div>
                    </div>

                    <div class="tab"><h3>Père Info:</h3>
                        <div class="form-group">
                            <label>Nom :</label>
                            <input type="text" name="nomPere" placeholder="Nom Père..." class="form-control" required='required'/>
                        </div>
                        <div class="form-group">
                            <label>Prénom :</label>
                            <input type="text" name="prenomPere" placeholder="Prènom Père..." class="form-control" required='required'/>
                        </div>
                        <div class="form-group">
                            <label>E-mail :</label>
                            <input type="text" name="emailPere" placeholder="E-mail..." class="form-control" required='required'/>
                        </div>
                        <div class="form-group">
                            <label>Téléphone :</label>
                            <input type="text" name="phonePere" placeholder="Phone..." class="form-control" required='required'/>
                        </div>
                    <!--<p><input placeholder="E-mail..." oninput="this.className = ''"></p>
                    <p><input placeholder="Phone..." oninput="this.className = ''"></p>-->
                    </div>

                    <div class="tab"><h3>Mère Info:</h3>
                        <div class="form-group">
                            <label>Nom :</label>
                            <input type="text" name="nomMere" placeholder="Nom mère..." class="form-control" required='required'/>
                        </div>
                        <div class="form-group">
                            <label>Prénom :</label>
                            <input type="text" name="prenomMere" placeholder="Prènom Mère..." class="form-control" required='required'/>
                        </div>
                        <div class="form-group">
                            <label>E-mail :</label>
                            <input type="text" name="emailMere" placeholder="E-mail..." class="form-control" required='required'/>
                        </div>
                        <div class="form-group">
                            <label>Téléphone :</label>
                            <input type="text" name="phoneMere" placeholder="Phone..." class="form-control" required='required'/>
                        </div>
                    <!--<p><input placeholder="E-mail..." oninput="this.className = ''"></p>
                    <p><input placeholder="Phone..." oninput="this.className = ''"></p>-->
                    </div>

                    <div style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-success">Previous</button>
                        <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-success">Next</button>
                    </div>
                    </div>

                    <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    </div>

                    </form>
                    <script>
                        var currentTab = 0; // Current tab is set to be the first tab (0)
                        showTab(currentTab); // Display the current tab

                        function showTab(n) {
                            // This function will display the specified tab of the form ...
                            var x = document.getElementsByClassName("tab");
                            x[n].style.display = "block";
                            // ... and fix the Previous/Next buttons:
                            if (n == 0) {
                                document.getElementById("prevBtn").style.display = "none";
                            } else {
                                document.getElementById("prevBtn").style.display = "inline";
                            }
                            if (n == (x.length - 1)) {
                                document.getElementById("nextBtn").innerHTML = "Submit";
                            } else {
                                document.getElementById("nextBtn").innerHTML = "Next";
                            }
                            // ... and run a function that displays the correct step indicator:
                            fixStepIndicator(n)
                        }

                        function nextPrev(n) {
                            // This function will figure out which tab to display
                            var x = document.getElementsByClassName("tab");
                            // Exit the function if any field in the current tab is invalid:
                            if (n == 1 && !validateForm()) return false;
                            // Hide the current tab:
                            x[currentTab].style.display = "none";
                            // Increase or decrease the current tab by 1:
                            currentTab = currentTab + n;
                            // if you have reached the end of the form... :
                            if (currentTab >= x.length) {
                                //...the form gets submitted:
                                document.getElementById("regForm").submit();
                                return false;
                            }
                            // Otherwise, display the correct tab:
                            showTab(currentTab);
                        }

                        function validateForm() {
                            // This function deals with validation of the form fields
                            var x, y, i, valid = true;
                            x = document.getElementsByClassName("tab");
                            y = x[currentTab].getElementsByTagName("input");
                            // A loop that checks every input field in the current tab:
                            for (i = 0; i < y.length; i++) {
                                // If a field is empty...
                                if (y[i].value == "") {
                                // add an "invalid" class to the field:
                                y[i].className += " invalid";
                                // and set the current valid status to false:
                                valid = false;
                                }
                            }
                            // If the valid status is true, mark the step as finished and valid:
                            if (valid) {
                                document.getElementsByClassName("step")[currentTab].className += " finish";
                            }
                            return valid; // return the valid status
                            }

                            function fixStepIndicator(n) {
                            // This function removes the "active" class of all steps...
                            var i, x = document.getElementsByClassName("step");
                            for (i = 0; i < x.length; i++) {
                                x[i].className = x[i].className.replace(" active", "");
                            }
                            //... and adds the "active" class to the current step:
                            x[n].className += " active";
                        }

                        $(function () {
                            $('#datetimepicker').datetimepicker({
                                format:'YYYY/MM/DD',
                                maxDate: new Date(new Date().getFullYear() - 17, 2,31)
                            });
                        });

                        document.getElementById("photo").addEventListener("change", validateFile);

                        function validateFile(){
                            const allowedExtensions =  ['jpg','png','gif','jpeg'],
                                    sizeLimit = 1000000; // 1 megabyte

                            // destructuring file name and size from file object
                            const { name:fileName, size:fileSize } = this.files[0];

                            /*
                            * if filename is apple.png, we split the string to get ["apple","png"]
                            * then apply the pop() method to return the file extension
                            *
                            */
                            const fileExtension = fileName.split(".").pop();

                            /*
                                check if the extension of the uploaded file is included
                                in our array of allowed file extensions
                            */
                            if(!allowedExtensions.includes(fileExtension)){
                                alert("file type not allowed");
                                this.value = null;
                            }else if(fileSize > sizeLimit){
                                alert("file size too large");
                                this.value = null;
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </body>
</HTML>
