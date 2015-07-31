<style>
.section{
    margin-left: -20px;
    margin-right: -20px;
    font-family: "Raleway",san-serif;
}

.landing{
    overflow-x: hidden;
}
.section h1{
    text-align: center;
    text-transform: uppercase;
    color: #808a97;
    font-size: 35px;
    font-weight: 700;
    line-height: normal;
    display: inline-block;
    width: 100%;
    margin: 50px 0 0;
}
.section ul{
    list-style-type: disc;
    padding-left: 15px;
}
.section:nth-child(even){
    background-color: #fff;
}
.section:nth-child(odd){
    background-color: #f1f1f1;
}
.section .section-title img{
    display: table-cell;
    vertical-align: middle;
    width: auto;
    margin-right: 15px;
}
.section h2,
.section h3 {
    display: inline-block;
    vertical-align: middle;
    padding: 0;
    font-size: 24px;
    font-weight: 700;
    color: #808a97;
    text-transform: uppercase;
}

.section .section-title h2{
    display: table-cell;
    vertical-align: middle;
    line-height: 25px;
}

.section-title{
    display: table;
}

.section h3 {
    font-size: 14px;
    line-height: 28px;
    margin-bottom: 0;
    display: block;
}

.section p{
    font-size: 13px;
    margin: 25px 0;
}
.section ul li{
    margin-bottom: 4px;
}
.landing-container{
    max-width: 750px;
    margin-left: auto;
    margin-right: auto;
    padding: 50px 0 30px;
}
.landing-container:after{
    display: block;
    clear: both;
    content: '';
}
.landing-container .col-1,
.landing-container .col-2{
    float: left;
    box-sizing: border-box;
    padding: 0 15px;
}
.landing-container .col-1 img{
    width: 100%;
}
.landing-container .col-1{
    width: 55%;
}
.landing-container .col-2{
    width: 45%;
}
.premium-cta{
    background-color: #808a97;
    color: #fff;
    border-radius: 6px;
    padding: 20px 15px;
}
.premium-cta:after{
    content: '';
    display: block;
    clear: both;
}
.premium-cta p{
    margin: 7px 0;
    font-size: 14px;
    font-weight: 500;
    display: inline-block;
    width: 60%;
}
.premium-cta a.button{
    border-radius: 6px;
    height: 60px;
    float: right;
    background: url(<?php echo YITH_YPOP_ASSETS_URL?>/images/upgrade.png) #ff643f no-repeat 13px 13px;
    border-color: #ff643f;
    box-shadow: none;
    outline: none;
    color: #fff;
    position: relative;
    padding: 9px 50px 9px 70px;
}
.premium-cta a.button:hover,
.premium-cta a.button:active,
.premium-cta a.button:focus{
    color: #fff;
    background: url(<?php echo YITH_YPOP_ASSETS_URL?>/images/upgrade.png) #971d00 no-repeat 13px 13px;
    border-color: #971d00;
    box-shadow: none;
    outline: none;
}
.premium-cta a.button:focus{
    top: 1px;
}
.premium-cta a.button span{
    line-height: 13px;
}
.premium-cta a.button .highlight{
    display: block;
    font-size: 20px;
    font-weight: 700;
    line-height: 20px;
}
.premium-cta .highlight{
    text-transform: uppercase;
    background: none;
    font-weight: 800;
    color: #fff;
}

.section.one{
    background: url(<?php echo YITH_YPOP_ASSETS_URL ?>/images/01-bg.png) no-repeat #fff; background-position: 85% 75%
}
.section.two{
    background: url(<?php echo YITH_YPOP_ASSETS_URL ?>/images/02-bg.png) no-repeat #fff; background-position: 85% 75%
}
.section.three{
    background: url(<?php echo YITH_YPOP_ASSETS_URL ?>/images/03-bg.png) no-repeat #fff; background-position: 85% 75%
}
.section.four{
    background: url(<?php echo YITH_YPOP_ASSETS_URL ?>/images/04-bg.png) no-repeat #fff; background-position: 85% 75%
}
.section.five{
    background: url(<?php echo YITH_YPOP_ASSETS_URL ?>/images/05-bg.png) no-repeat #fff; background-position: 85% 75%
}
.section.six{
    background: url(<?php echo YITH_YPOP_ASSETS_URL ?>/images/06-bg.png) no-repeat #fff; background-position: 85% 75%
}
.section.seven{
    background: url(<?php echo YITH_YPOP_ASSETS_URL ?>/images/07-bg.png) no-repeat #fff; background-position: 85% 75%
}


@media (max-width: 768px) {
    .section{margin: 0}
    .premium-cta p{
        width: 100%;
    }
    .premium-cta{
        text-align: center;
    }
    .premium-cta a.button{
        float: none;
    }
}

@media (max-width: 480px){
    .wrap{
        margin-right: 0;
    }
    .section{
        margin: 0;
    }
    .landing-container .col-1,
    .landing-container .col-2{
        width: 100%;
        padding: 0 15px;
    }
    .section-odd .col-1 {
        float: left;
        margin-right: -100%;
    }
    .section-odd .col-2 {
        float: right;
        margin-top: 65%;
    }
}

@media (max-width: 320px){
    .premium-cta a.button{
        padding: 9px 20px 9px 70px;
    }

    .section .section-title img{
        display: none;
    }
}
</style>
<div class="landing">
    <div class="section section-cta section-odd">
        <div class="landing-container">
            <div class="premium-cta">
                <p>
                    <?php echo sprintf( __('Upgrade to %1$spremium version%2$s of %1$sYITH WooCommerce Popup%2$s to benefit from all features!','yith-wacp'),'<span class="highlight">','</span>' );?>
                </p>
                <a href="<?php echo $this->get_premium_landing_uri() ?>" target="_blank" class="premium-cta-button button btn">
                    <span class="highlight"><?php _e('UPGRADE','yith-wacp');?></span>
                    <span><?php _e('to the premium version','yith-wacp');?></span>
                </a>
            </div>
        </div>
    </div>
    <div class="one section section-even clear">
        <h1><?php _e('Premium Features','yith-wacp');?></h1>
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YPOP_ASSETS_URL ?>/images/01.png" alt="Shop or detail page?" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YPOP_ASSETS_URL ?>/images/01-icon.png" alt="icon 01"/>
                    <h2><?php _e('6 popup templates','yith-wacp');?></h2>
                </div>
                <p>
                    <?php echo sprintf(__('A plugin based on the freedom to choose: %1$ssix different templates%2$s to create a suitable popup for every occasion, from the unmissable offer to the simple informative message, you will also find the perfect and most charming solution.%3$sYou can completely customize the colors of each template, in order to get to the best graphic result.', 'yith-wacp'), '<b>', '</b>','<br>');?>
                </p>
            </div>
        </div>
    </div>
    <div class="two section section-odd clear">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YPOP_ASSETS_URL ?>/images/02-icon.png" alt="icon 02" />
                    <h2><?php _e('Popup position','yith-wacp');?></h2>
                </div>
                <p>
                    <?php echo sprintf(__('Different studies try to understand which are the best strategies to catch immediately users\' attention, which is always evasive and rapid in its eye movement through the web pages.%3$sEach detail contributes critically to the success of the %1$sstrategy%2$s, especially the positioning of the elements in the page.%3$sChoose your strategy and select the position in which you want to show the %1$spopup%2$s: all solutions are ready for you. ', 'yith-wacp'), '<b>', '</b>','<br>');?>
                </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YPOP_ASSETS_URL ?>/images/02.png" alt="Popup content" />
            </div>
        </div>
    </div>
    <div class="three section section-even clear">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YPOP_ASSETS_URL ?>/images/03.png" alt="Animations" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YPOP_ASSETS_URL ?>/images/03-icon.png" alt="icon 03" />
                    <h2><?php _e( 'When do you want to shoe the popup?','yith-wacp');?></h2>
                </div>
                <p>
                    <?php echo sprintf(__('You are not obliged to display popups after the loading of the page in the browser. The premium version of the %1$sYITH WooCommerce Popup%2$s plugin lets you choose alternative solutions. For example, you can display it when users abandon the browser viewport, exit the page, or click on a link that drives them to an external domain.', 'yith-wacp'), '<b>', '</b>','<br>');?>
                </p>
            </div>
        </div>
    </div>
    <div class="four section section-odd clear">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YPOP_ASSETS_URL ?>/images/04-icon.png" alt="icon 04" />
                    <h2><?php _e('Unique contents','yith-wacp');?></h2>
                </div>
                <p>
                    <?php echo sprintf(__('Three kinds of additional contents for your popups. You will be able to add all the most famous %1$ssocial network%2$s profiles (Facebook, Twitter, LinkedIn, Google+ and Pinterest), integrate one of the %1$scontact form%2$s already created and configured on your site (with YIT Contact Form or Contact Form 7), or create a %1$stextual%2$s type for a message aimed to the users of the shop.', 'yith-wacp'), '<b>', '</b>');?>
                </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YPOP_ASSETS_URL ?>/images/04.png" alt="popup style" />
            </div>
        </div>
    </div>
    <div class="section section-cta section-odd">
        <div class="landing-container">
            <div class="premium-cta">
                <p>
                    <?php echo sprintf( __('Upgrade to %1$spremium version%2$s of %1$sYITH WooCommerce Popup%2$s to benefit from all features!','yith-wacp'),'<span class="highlight">','</span>' );?>
                </p>
                <a href="<?php echo $this->get_premium_landing_uri() ?>" target="_blank" class="premium-cta-button button btn">
                    <span class="highlight"><?php _e('UPGRADE','yith-wacp');?></span>
                    <span><?php _e('to the premium version','yith-wacp');?></span>
                </a>
            </div>
        </div>
    </div>
</div>