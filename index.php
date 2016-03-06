<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="chynkm@gmail.com">
        <link rel="icon" href="favicon.ico">
        <title>TCP Wrapper</title>
        <!-- Bootstrap core CSS -->
        <link href="bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="custom.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">TCP Wrapper</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-header">Nav header</li>
                                <li><a href="#">Separated link</a></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>
        <!-- Begin page content -->
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <h1>Sticky footer with fixed navbar</h1>
                </div>
            </div>
            <div class="row">
                <p class="lead">
                    Host Access Control allows you to set up specific rules to allow or deny access to your server and services on it based on the IP address that is attempting to connect. It is general practice that denying all connections and only allowing connections that you wish to proceed is the most secure way to use Host Access Control.
                    <br>
                    <br>
                    To set up a rule, you will need to add the service you wish to create the rule for, the IP address(es) you wish to allow or deny, and then the action to be taken (allow or deny).
                    <br>
                    <br>
                    For example, you could set up the following rules to lock down your SSH service:</p>
                    <br>
                    <table>
                        <tbody><tr>
                            <th>Daemon</th>
                            <th>Access List</th>
                            <td>&nbsp;</td>
                            <th>Action</th>
                            <td>&nbsp;</td>
                            <th>Comment</th>
                        </tr>
                        <tr>
                            <td>sshd</td>
                            <td>192.168.0.0/255.255.255.0</td>
                            <td>&nbsp;</td>
                            <td>allow</td>
                            <td>&nbsp;</td>
                            <td>Allow local SSH access</td>
                        </tr>
                        <tr>
                            <td>sshd</td>
                            <td>198.66.254.254</td>
                            <td>&nbsp;</td>
                            <td>allow</td>
                            <td>&nbsp;</td>
                            <td>Allow SSH from my specific IP</td>
                        </tr>
                        <tr>
                            <td>sshd</td>
                            <td>ALL</td>
                            <td>&nbsp;</td>
                            <td>deny</td>
                            <td>&nbsp;</td>
                            <td>Deny access from all other IPs</td>
                        </tr>
                    </tbody>
                    </table>
                    <br>
                    <p class="description">Note that the rules have an order of precedence. You need to place your allow rules before your deny rules if you are choosing to use the allow from a few, then deny from all technique.
                    <br>
                    You can also use "ALL EXCEPT x.x.x.x" as an Access List which will allow all IP addresses except x.x.x.x (replace with a specific IP address).</p>
                </p>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    Daemon
                </div>
                <div class="col-lg-3">
                    Access List
                </div>
                <div class="col-lg-2">
                    Action
                </div>
                <div class="col-lg-4">
                    Comment
                </div>
            </div>
            <form role="form" class="tcp_rules">
                <?php include('./wrapper_template.php'); ?>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-primary pull-right" id="add_row">Add +</button>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="text-muted">&copy; M Networks <?php echo date('Y'); ?></p>
            </div>
        </footer>
        <!-- Bootstrap core JavaScript
            ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="jquery.min.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="tcp_wrapper.js"></script>
    </body>
</html>