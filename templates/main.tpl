<!DOCTYPE html>
<html>
<head>
    {include file='includes/head.tpl'}
</head>

<body>

<div class="container">
    <br>
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <span class="navbar-brand">Project name</span>
        </div>

        {$core->drawBlock(1)}
    </div>

    <div class="row">
        <div class="col-lg-3">
            {$core->drawBlock(2)}
        </div>

        <div class="col-lg-6">
            {$core->drawBlock('main')}
        </div>

        <div class="col-lg-3">
            {$core->drawBlock(3)}
        </div>
    </div>

    {include file='includes/footer.tpl'}
</div>
</body>
</html>