<?php
session_start();
if($_SESSION['logged_in'] != 1)
    header("location: login.php");

// define variables and set to empty values
$daemon_error = $access_list_error = $action_error = '';
$daemon       = $access_list       = $action       = $comment = '';

include('File_helper.php');
$helper = new File_helper;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $rules = array();
    for ($i=0; $i < count($_POST['daemon']) ; $i++)
    {
        if (empty($_POST["daemon"][$i]))
        {
            $daemon_error = "Daemon is required.";
            $daemon       = '';
        }
        else
            $daemon = test_input($_POST["daemon"][$i]);

        if (empty($_POST["access_list"][$i]))
        {
            $access_list_error = "Access List is required.";
            $access_list       = '';
        }
        else
            $access_list = test_input($_POST["access_list"][$i]);

        if (empty($_POST["action"][$i]))
        {
            $action_error = "Action is required.";
            $action       = '';
        }
        else
            $action = test_input($_POST["action"][$i]);

        $comment = $_POST["comment"][$i] ? test_input($_POST["comment"][$i]) : '';

        $rules[] = array(
            'daemon'        => $daemon,
            'access_list'   => $access_list,
            'action'        => $action,
            'comment'       => $comment,
        );
    }
    if($rules)
        $helper->write($rules);
}
else
    $rules = $helper->read();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if(substr($data, -1) == ',')
        $data = rtrim($data, ",");
    return $data;
}
?>
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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/jquery-ui.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/custom.css" rel="stylesheet">
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
                    <a class="navbar-brand" href="#">TCP Wrapper</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="logout.php">Logout</a></li>
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
            <?php if($daemon_error || $access_list_error || $action_error): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php if($daemon_error):?>
                        <?php echo $daemon_error; ?><br/>
                    <?php endif;?>
                    <?php if($access_list_error):?>
                        <?php echo $access_list_error; ?><br/>
                    <?php endif;?>
                    <?php if($action_error) echo $action_error; ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-2">
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
                <div class="col-lg-1">
                    Delete
                </div>
            </div>
            <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="row tcp_rules">
                    <?php if($rules): ?>
                        <?php foreach ($rules as $row): ?>
                            <div class="row tcp_wrapper_template_row"><div class="col-lg-2"><div class="form-group"><input type="text" placeholder="Daemon" name="daemon[]" value="<?php echo $row['daemon']; ?>" class="form-control daemon"></div></div><div class="col-lg-3"><div class="form-group"><input type="text" placeholder="Access List" name="access_list[]" value="<?php echo $row['access_list']; ?>" class="form-control"></div></div><div class="col-lg-2"><div class="form-group"><input type="text" placeholder="Action" name="action[]" value="<?php echo $row['action']; ?>" class="form-control action"></div></div><div class="col-lg-4"><div class="form-group"><input type="text" placeholder="Comment" name="comment[]" value="<?php echo $row['comment']; ?>" class="form-control"></div></div><div class="col-lg-1"><button type="button" class="btn btn-danger delete_row"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></div></div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php include('./wrapper_template.php'); ?>
                    <?php endif;?>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    <div class="col-lg-6">
                        <button type="button" class="btn btn-success pull-right" id="add_row">Add +</button>
                    </div>
                </div>
            </form>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="text-muted">&copy; M Networks <?php echo date('Y'); ?></p>
            </div>
        </footer>
        <!-- Bootstrap core JavaScript
            ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/tcp_wrapper.js"></script>
    </body>
</html>