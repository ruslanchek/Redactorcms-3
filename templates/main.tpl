<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{$core->page->content->seo_title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="{$core->page->content->seo_keywords}">
        <meta name="description" content="{$core->page->content->seo_description}">

        <link href="/templates/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <style>
            body {
                padding-top: 60px;
            }
        </style>

        <link href="/templates/resources/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

        <script src="/templates/resources/js/jquery-1.7.min.js"></script>
        <script src="/templates/resources/bootstrap/js/bootstrap.min.js"></script>
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

                    <br>
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

                    <br>
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

                    <br>
                </div>
            </div>
            <pre>
                {$core->page|print_r}
            </pre>
        </div>
    </body>
</html>

