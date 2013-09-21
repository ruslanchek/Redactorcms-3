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
            <a class="navbar-brand" href="/">Project name</a>
        </div>

        {$core->drawBlock(1)}
    </div>

    {$core->drawBlock('main')}

    {include file='includes/footer.tpl'}
</div>
</body>
</html>
