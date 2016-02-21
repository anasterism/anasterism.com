<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="An Asterism" />
    <meta name="copyright" content="An Asterism" />
    <title>An Asterism - Dayton, OH Web Design + Development</title>
</head>
<body>

    <!-- google analytics -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');    
        ga('create', 'UA-45549297-1', 'auto');
        ga('send', 'pageview');
    </script>
  
    <div id="app" class="content">

        <!-- logo -->
        <div id="anAsterism" title="Dayton, OH Web Design and Development">
            <img src="/images/LogoOnDark.png" alt="An Asterism – Dayton, OH Web Design and Development">
        </div>

        <!-- contact form -->
        <div id="contactForm" class="animated" style="display: none" v-show="formState == 'active'" transition="form-transition">
        
            <div class="row">
                <div class="fieldset" :class="{ 'isInvalid': errors.hasError.name }">
                    <label for="fullName"><span class="fa fa-exclamation-circle">&nbsp;</span> Full Name</label>
                    <input type="text" id="fullName" tabindex="1" v-model="form.name" placeholder="Full Name" />
                </div>

                <div class="fieldset" :class="{ 'isInvalid': errors.hasError.company }">
                    <label for="company"><span class="fa fa-exclamation-circle">&nbsp;</span> Company</label>
                    <input type="text" id="company" tabindex="2" v-model="form.company" placeholder="Company" />
                </div>
            </div>

            <div class="row">
                <div class="fieldset" :class="{ 'isInvalid': errors.hasError.email }">
                    <label for="email"><span class="fa fa-exclamation-circle">&nbsp;</span> Email</label>
                    <input type="text" id="email" tabindex="3" v-model="form.email" placeholder="Email" />
                </div>

                <div class="fieldset" :class="{ 'isInvalid': errors.hasError.phone }">
                    <label for="phone"><span class="fa fa-exclamation-circle">&nbsp;</span> Phone</label>
                    <input type="text" id="phone" tabindex="4" v-model="form.phone" placeholder="(555) 555-5555" />
                </div>
            </div>

            <div class="row">
                <option-select :list="projectOptions"></option-select>
            </div>

            <div class="row">
                <div class="field" :class="{ 'isInvalid': errors.hasError.message }">
                    <label for="message"><span class="fa fa-exclamation-circle">&nbsp;</span> Message</label>
                    <textarea id="phone" tabindex="5" v-model="form.message" placeholder="Tell us about it..."></textarea>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="controls">
                <button @click="process" :class="{ 'circle': formState == 'success', 'static': formState == 'active' || formState == 'loading' }">
                    <span class="fa fa-envelope fa-lg" v-show="formState == 'inactive'"></span>
                    <span class="fa fa-paper-plane fa-lg" v-show="formState == 'active'"></span>
                    <span class="fa fa-cog fa-lg fa-spin" v-show="formState == 'loading'"></span>
                    <span class="animated fa fa-heart fa-3x" v-show="formState == 'success'"></span>
                </button>
            </div>
        </div>

        <div id="foot">
            <div id="copyright">
                &copy; An Asterism {{ date('Y') }}. <span class="reserved">All rights reserved.</span>
            </div>
            <div id="social">
                <a href="http://www.github.com/anasterism/anasterism.com" target="_blank" rel="external"><i class="fa fa-github fa-2x"></i></a>
                <a href="https://www.facebook.com/an.asterism/" target="_blank" rel="external"><i class="fa fa-facebook-square fa-2x"></i></a>
                <a href="http://www.twitter.com/an_asterism" target="_blank" rel="external"><i class="fa fa-twitter fa-2x"></i></a>
            </div>
        </div>
        
        <error-prompt :messages="errors.messages" v-show="errors.display"></error-prompt>

    </div>

    <!---
    TEMPLATE: OPTION SELECT
    -->
    <template id="option-select">

        <div class="field">
            <label>Project Type</label>
            <ul class="optionSelect">
                <li :class="{ 'selected': option.selected }" v-for="option in list" @click="option.selected = ! option.selected">
                    <span class="optionToggle"><span>+</span></span>
                    <span class="optionLabel">@{{ option.value }}</span> <span v-show="option.selected" class="optionNotes">@{{ option.notes }}</span>
                </li>
            </ul>
        </div>

    </template>

    <!---
    TEMPLATE: ERROR ALERT
    -->
    <template id="error-prompt">

        <div class="animated prompt error" transition="prompt-transition">
            <span class="fa fa-exclamation-circle"></span>&nbsp; <span class="prompt-title">Please correct the following:</span>
            <ul>
                <li v-for="message in messages"><span class="fa fa-exclamation"></span>&nbsp; @{{ message }}</li>
            </ul>
        </div>

    </template>

    <!-- stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ elixir("css/all.css") }}" />
    <!-- javascript -->
    <script type="text/javascript" src="/js/vendor.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>
</body>
</html>
