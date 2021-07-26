<?php
$date    = date('YmdHis');
$title   = 'Last-Hammer';
$version = 'v1.1.0.0';
$tzlist  = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

$tzoutput = '';
foreach ($tzlist as $key => $value) {
    if ($value !== 'UTC') {
        $tzoutput .= '<option value="' . $value . '">' . $value . '</option>';
    }
}


?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge"/>
    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=5, initial-scale=1, user-scalable=0, shrink-to-fit=no"/>
    <title>
        <?php echo $title; ?>
    </title>
    <!-- Icono  de la web -->
    <link rel="shortcut icon" href="favicon.ico?<?php echo $date; ?>"/>
    <link rel="icon" href="asset/img/logo/favicon.png?<?php echo $date; ?>" type="image/png"/>
    <link rel="stylesheet" href="asset/css/adds/reset.css?<?php echo $date; ?>">
    <link rel="stylesheet" href="asset/css/adds/destyle.css?<?php echo $date; ?>">
    <link rel="stylesheet" href="asset/css/adds/bootstrap.css?<?php echo $date; ?>">
    <link rel="stylesheet" href="asset/font/fontawesome/css/all.min.css?<?php echo $date; ?>">
    <link rel="stylesheet" href="asset/css/lh.css?<?php echo $date; ?>">
</head>

<body class="d-flex flex-column h-100">
<main role="main" class="flex-shrink-0">
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-lg-8">
                <h2><b>Last-Hammer Installation Form</b></h2>
                <div class="form-group row text-danger font-italic">
                    Note: fill out this form to create your project seed.<br>
                    It is important that you have the updated information.<br>
                    You can print it out and fill it out by hand first and then transcribe the data or Use default for Testing.
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block mb-3">
                <img src="/asset/img/logo/favicon.png" class="img-fluid float-right" alt="Responsive image">
            </div>
        </div>
        <hr>
        <div id="wait" class="d-flex align-items-center mb-5 mt-5"><p><b>Checking Lastest Version Core...</b></p><br><img src="asset/img/logo/loader.gif" alt="Loading"></div>
        <form id="formInstallation" class="d-none">
            <div class="form-group row align-items-center d-print-none">
                <label class="col-lg-3 col-form-label font-weight-bold">Use Default Setting?:</label>
                <div class="col-lg-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="defaultsetting" id="defaultsetting1" value="false" checked>
                        <label class="form-check-label" for="defaultsetting1">no</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="defaultsetting" id="defaultsetting2" value="true">
                        <label class="form-check-label" for="defaultsetting2">yes</label>
                    </div>
                </div>
                <label class="col-lg-2 col-form-label text-right font-weight-bold" for="lh-version">Version:</label>
                <div class="col-lg-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-code-branch"></i></span>
                        </div>
                        <input type="text" class="form-control" id="lh-version" name="lh-version" value="<?php echo $version; ?>" readonly>
                    </div>
                </div>
                <div class="col-lg-3">
                    <button type="button" class="btn btn-primary d-none" name="update" id="update">Update Available!</button>
                    <label class="col-form-label text-danger d-none" id="notupdate">You have Latest Version!</label>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label class="col-lg-12 text-center font-weight-bold">Company Information</label>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label" for="company-name">Company Name:</label>
                <div class="col-lg-5">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                        </div>
                        <input type="text" class="form-control" id="company-name" name="company-name" placeholder="Company Inc. LTD">
                    </div>
                </div>
                <label class="col-lg-2 col-form-label" for="company-id">Company ID:</label>
                <div class="col-lg-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                        </div>
                        <input type="text" class="form-control" id="company-id" name="company-id" placeholder="10-0004-66667-1">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label" for="company-address">Company Address:</label>
                <div class="col-lg-10">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" id="company-address" name="company-address" placeholder="1345 NW 98TH CT UNIT 2">
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label class="col-lg-12 text-center font-weight-bold">Contact Information</label>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="cont-name-dep">Name Area/Departament:</label>
                <div class="col-lg-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-users-cog"></i></span>
                        </div>
                        <input type="text" class="form-control" id="cont-name-dep" name="cont-name-dep" placeholder="Tecnology/I.D.">
                    </div>
                </div>
                <label class="col-lg-3 col-form-label" for="cont-name-per">Name of the contact Person:</label>
                <div class="col-lg-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                        </div>
                        <input type="text" class="form-control" id="cont-name-per" name="cont-name-per" placeholder="Ing. James P. Walkker">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label" for="cont-email">Contact E-mail:</label>
                <div class="col-lg-5">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                        </div>
                        <input type="text" class="form-control" id="cont-email" name="cont-email" placeholder="it.development@e-mail.com.co">
                    </div>
                </div>
                <label class="col-lg-2 col-form-label" for="cont-phone">Contact Phones:</label>
                <div class="col-lg-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone-rotary"></i></span>
                        </div>
                        <input type="text" class="form-control" id="cont-phone" name="cont-phone" placeholder="(+507) 236-45-78">
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label class="col-lg-12 text-center font-weight-bold">Project Information (Requires Technical Information.)</label>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="project-name">Desired Software Name:</label>
                <div class="col-lg-9">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-project-diagram"></i></span>
                        </div>
                        <input type="text" class="form-control" id="project-name" name="project-name" placeholder="Company ERP | AnyName CRM | System Name">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" data-toggle="modal" id="bt-project-name-help" data-target="#project-name-help">?</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="project-name-label">Label Name Preview:</label>
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-project-diagram"></i></span>
                        </div>
                        <input type="text" class="form-control" id="project-name-label" name="project-name-label" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" data-toggle="modal" id="bt-project-name-label-help" data-target="#project-name-label-help">?</button>
                        </div>
                    </div>
                </div>
                <label class="col-lg-2 col-form-label" for="project-license">License:</label>
                <div class="col-lg-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-list-ol"></i></span>
                        </div>
                        <select class="form-control" name="project-license" id="project-license">
                            <option value="1" selected>Open Source</option>
                            <option value="2">Basic Icaros Net</option>
                            <option value="3">Pro Icaros Net</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" data-toggle="modal" id="bt-project-license-help" data-target="#project-license-help">?</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="project-icaros-license">Token (for Icaros License):</label>
                <div class="col-lg-9">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-scroll"></i></span>
                        </div>
                        <input type="text" class="form-control" id="project-icaros-license" name="project-icaros-license" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" data-toggle="modal" id="bt-project-token-help" data-target="#project-token-help">?</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="project-zone">Zone (Region/City):</label>
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                        </div>
                        <select class="form-control" name="s_list_2" id="project-zone"><?php echo $tzoutput; ?></select>
                    </div>
                </div>
                <label class="col-lg-3 col-form-label" for="project-lang">Primary language:</label>
                <div class="col-lg-2">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-language"></i></span>
                        </div>
                        <select class="form-control" name="s_list_3" id="project-lang">
                            <option value="en" selected>English</option>
                            <option value="es">Español</option>
                            <option value="fr">Français</option>
                            <option value="pt">Português</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="project-domain">Project Domain(URL):</label>
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-brackets-curly"></i></span>
                        </div>
                        <input name="project-domain" id="project-domain" placeholder="http://www.domain.com/" class="form-control" type="text">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" data-toggle="modal" id="bt-project-domain-help" data-target="#project-domain-help">?</button>
                        </div>
                    </div>
                </div>
                <label class="col-lg-2 col-form-label" for="project-environment">Environment:</label>
                <div class="col-lg-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                        </div>
                        <select class="form-control" name="s_list_4" id="project-environment">
                            <option value="0" selected>Local</option>
                            <option value="1">Development/Trunk</option>
                            <option value="2">Integration</option>
                            <option value="3">Testing/Test/QC/Internal Acceptance</option>
                            <option value="4">Staging/Stage/Model/Pre-production/External-Client Acceptance/Demo</option>
                            <option value="5">Production/Live</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" data-toggle="modal" id="bt-project-environment-help" data-target="#project-environment-help">?</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label class="col-lg-12 text-center font-weight-bold">Information for Migration of Different Environments (Requires Technical Information.)</label>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 text-danger font-italic">
                    <b>Requirements:</b><br>
                    1. Have the same Version running on both Targets Environments.<br>
                    <b>Note:</b><br>
                    The Migration Tool will not migrate customizations / changes to the Last-Hammer System Core or Data Base Core.<br>
                    The Migration Tool will not modify or make changes to the Last-Hammer Origin Target.
                </div>
            </div>
            <label class="col-lg-2 col-form-label font-weight-bold">Migrate Source Code?:</label>
            <div class="col-lg-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="lh-migrate-sc" id="lh-migrate-sc1" value="false" checked>
                    <label class="form-check-label" for="lh-migrate-sc1">no</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="lh-migrate-sc" id="lh-migrate-sc2" value="true">
                    <label class="form-check-label" for="lh-migrate-sc2">yes</label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-12 control-label text-danger font-italic">Automatically import the code from another environment using FTP protocol to Copy Files.</label>
            </div>
            <label class="col-lg-2 col-form-label font-weight-bold">Migrate Data Base?:</label>
            <div class="col-lg-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="lh-migrate-db" id="lh-migrate-db1" value="false" checked>
                    <label class="form-check-label" for="lh-migrate-db1">no</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="lh-migrate-db" id="lh-migrate-db2" value="true">
                    <label class="form-check-label" for="lh-migrate-db2">yes</label>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label class="col-lg-12 control-label text-danger font-italic">Automatically import the database from another environment using Driver PDO to Create a Backup and restore it in this Instance.</label>
            </div>
        </form>
    </div>
</main>
<footer class="footer mt-auto py-3 bg-black">
    <div class="container">
        <span class="text-white">Icaros Net S.A. ------ Last-Hammer</span>
    </div>
</footer>

<!-- Modal -->
<div class="modal fade" id="project-name-help" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Desired Software Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="project-name-label-help" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Label Name Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="project-license-help" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">License</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="project-token-help" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Token (for Icaros License)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="project-domain-help" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Project Domain(URL)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="project-environment-help" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Environment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JS Files -->
<script defer src="asset/js/adds/jquery.min.js?<?php echo $date; ?>"></script>
<script defer src="asset/js/adds/popper.min.js?<?php echo $date; ?>"></script>
<script defer src="asset/js/adds/bootstrap.js?<?php echo $date; ?>"></script>
<script defer src="asset/js/adds/axios.min.js?<?php echo $date; ?>"></script>


<!-- Return Home Script -->
<!--suppress JSUnresolvedVariable -->
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {

        const project_version = document.getElementById("lh-version").value;
        const project_default = {
            company_name: "Test-Company LTD",
            company_id: "00-0000-00000-1",
            company_address: "Test Address",
            cont_name_dep: "Test Departament",
            cont_name_per: "Test User",
            cont_email: "Test Email",
            cont_phone: "+000 0000-0000",
            project_name: "Test Last-Hammer",
            project_name_label: "test-Last-Hammer",
            project_license: 1,
            project_icaros_license: ""
        };

        function GetVersion(path) {
            return new Promise(function (resolve) {
                axios.get(path).then(
                    (response) => {
                        let result = response.data;
                        console.log('Processing Request');
                        resolve(result);
                    },
                    (error) => {
                        resolve(error);
                    }
                );
            });
        }

        async function main() {

            /*In this section, the version is evaluated before viewing the installation form.*/

            let result = await GetVersion('https://api.github.com/repos/arcanisgk/BEH-Basic-Error-Handler/releases/latest');
            console.log(result.tag_name);
            if (!result.hasOwnProperty('tag_name')) {
                console.log('Error: Could not determine the Version of Last-Hammer');
            } else {
                if (result.tag_name === project_version) {
                    document.getElementById('notupdate').classList.toggle("d-block");
                    document.getElementById('notupdate').classList.toggle("d-none");
                } else {
                    document.getElementById('update').classList.toggle("d-block");
                    document.getElementById('update').classList.toggle("d-none");
                }
            }

            document.getElementById('wait').classList.toggle("d-flex");
            document.getElementById('wait').classList.toggle("d-none");
            document.getElementById('formInstallation').classList.toggle("d-block");
            document.getElementById('formInstallation').classList.toggle("d-none");

            /*This section evaluates whether the user wants to use the default parameters.*/

            let settins = document.getElementsByName("defaultsetting");
            Object.keys(settins).forEach(key => {
                settins[key].addEventListener("change", function () {
                    let value = this.value;
                    if (value !== 'true') {
                        for (let key in project_default) {
                            if (project_default.hasOwnProperty(key)) {
                                let elementid = key.split("_").join('-');
                                if (key !== 'project_license') {
                                    console.log(elementid + '->' + key + '->' + project_default[key]);
                                    document.getElementById(elementid).value = '';
                                    document.getElementById(elementid).classList.remove("disabled");
                                    document.getElementById(elementid).readOnly = false;
                                } else {
                                    console.log(elementid + '->' + key + '->' + project_default[key]);
                                    document.getElementById(elementid).value = project_default[key];
                                    document.getElementById(elementid).removeAttribute("disabled");
                                }
                            }
                        }
                    } else {
                        for (let key in project_default) {
                            if (project_default.hasOwnProperty(key)) {
                                let elementid = key.split("_").join('-');
                                if (key !== 'project_license') {
                                    console.log(elementid + '->' + key + '->' + project_default[key]);
                                    document.getElementById(elementid).value = project_default[key];
                                    document.getElementById(elementid).classList.add("disabled");
                                    document.getElementById(elementid).readOnly = true;
                                } else {
                                    console.log(elementid + '->' + key + '->' + project_default[key]);
                                    document.getElementById(elementid).value = project_default[key];
                                    document.getElementById(elementid).setAttribute("disabled", "disabled");
                                }
                            }
                        }
                    }
                });
            });

            /*In this section, the System Update is executed if required.*/

            /*In this section we capture some form events to provide some functionality to the fields.*/

        }

        main();

    });
</script>
</body>

</html>
