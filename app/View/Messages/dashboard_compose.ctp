<?php	echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'); ?>

<?php echo $this->Html->css("dashboard/style") ?>

<?php echo $this->Html->css("dashboard/token-input-facebook") ?>

<?php echo $this->Html->script("dashboard/jquery.tokeninput") ?>

<?php echo $this->element('mail_search') ?>
<?php echo $this->element('mail_menu') ?>

<?php echo $this->Html->scriptBlock("
    $(document).ready(function() {
    
        $('#send').click(function() {
            sendmail();
            return false;
        });
        
        $('#save').click(function() {
            savemail();
            return false;
        });
        
        function sendmail(e) {
            if ($('#to').val().length == 0) {
                $('#to').parent().addClass('error');
                $('#to').parent().append('<div class=\"error-message\">A valid recipient is required.</div>');
                return false;
            }
            $.ajax({
                url: '/dashboard/messages/send_mail/',
                type: 'POST',
                data: {
                    id: $('#id').val(),
                    to: $('#to').val(),
                    subject: $('#subject').val(),
                    parentmail: $('#parent').val(),
                    message: $('#message').val()
                }
            }).done(function() {
                location.href = '/dashboard/messages/inbox';
            }).fail(function() {
                location.reload();
            });
            return false;
        }
        
        function savemail(e) {
            $.ajax({
                url: '/dashboard/messages/save_mail/',
                type: 'POST',
                data: {
                    id: $('#id').val(),
                    to: $('#to').val(),
                    subject: $('#subject').val(),
                    parent: $('#parent').val(),
                    message: $('#message').val()
                }
            }).done(function(msg) {
                if (msg.length > 0) {
                    $('#id').val(msg);
                }
            }).fail(function() {
                location.reload();
            });
            return false;
        }
        
        function isValidEmailAddress(e) {
            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if (filter.test(e)) {
                return true;
            }
            else {
                return false;
            }
        };
                
    });
") ?>


<form class="mail">
    
<input type="hidden" name="mailid" id="id" value="" />
<input type="hidden" name="parent" id="parent" value="" />

<div id="messageForm" style="display:block; margin-top: 10px">
    <div class="messageActions actions" style="width: 100% !important; clear:both">
        <a href="/dashboard/messages/inbox" class="actions">< Back to Inbox</a> 
        <a href="#send" class="actions" id="send">Send</a>
        <a href="#save" class="actions" id="save">Save</a>
    </div>
    
    <div class="messageTo" style="margin-top: 50px">To <input type="text" id="to" autocomplete="off" name="to" placeholder="Name or Email Address" value="" /></div>
    <div class="messageSubject">Subject <input type="text" id="subject" name="subject" value="" /></div>
    <div class="messageAttachment"><a href="#"><sub>Attach a file</sub></a></div>
    <textarea name="message" id="message" rows="15"></textarea>
</div>

</form>

<br />