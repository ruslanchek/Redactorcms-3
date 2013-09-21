<!DOCTYPE html>
<html>
<head>
    {include file='includes/head.tpl'}
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="/">Demo</a>
        </div>
    </div>
</div>

<div class="container">

    <div class="thumbnail">
        <h4>Block 6</h4>
        {$core->drawBlock(6)}
    </div>

    <div class="page-header">
        <h1>{$core->page->content->seo_title}</h1>
    </div>

    <div class="thumbnail">
        <h4>Block 7</h4>
        {$core->drawBlock(7)}
    </div>

    <hr>

    <div class="row">
        <div class="span3">
            <div class="thumbnail">
                <div class="caption">
                    <h4>Block 1</h4>

                    <div>{$core->drawBlock(1)}</div>
                </div>
            </div>

            <br>

            <div class="thumbnail">
                <div class="caption">
                    <h4>Block 2</h4>

                    <div>{$core->drawBlock(2)}</div>
                </div>
            </div>
        </div>

        <div class="span6">
            <div class="thumbnail">
                <div class="caption">
                    <h4>Main block</h4>

                    <div>{$core->drawBlock('main')}</div>
                </div>
            </div>

            <br>

            <div class="thumbnail">
                <div class="caption">
                    <h4>Block 3</h4>

                    <div>{$core->drawBlock('3')}</div>
                </div>
            </div>
        </div>


        <div class="span3">
            <div class="thumbnail">
                <div class="caption">
                    <h4>Block 4</h4>

                    <div>{$core->drawBlock(4)}</div>
                </div>
            </div>

            <br>

            <div class="thumbnail">
                <div class="caption">
                    <h4>Block 5</h4>

                    <div>{$core->drawBlock(5)}</div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    {include file='includes/footer.tpl'}
</div>
</body>
</html>

