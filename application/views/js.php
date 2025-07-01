<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/jquery.min.js">

</script><script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/main.js?v=1.2.3.7"></script>


<?php $this->load->view('schema');?>

<script>
    function startTime() {
      const today = new Date();
      let h = today.getHours();
      let m = today.getMinutes();
      let s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
      setTimeout(startTime, 1000);
    }
    
    function checkTime(i) {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
    }
    </script>
<?php
if($class=='home'){
?>
 <script type="text/javascript">
    $(document).ready(function($) {
        $('.clc').click(function(event) {
            var src = $(this).attr('data-src')+'?autoplay=1';
            $('.featured_video iframe').attr('src', src);
            return false;
        });
    });
</script>


<script>
	jQuery(document).ready(function($) {
		// alert-banner
		$('.ticks .x-close').click(function(event) {
			$(this).parents('.ticks').slideUp('slow');
			return false;
		});
		$('.ticks').slideDown('slow');
		
		/////bottom sticky ad /////
		$('.body-ad-bottom .x-btn').click(function(event) {
            event.preventDefault();
            $(this).parent('.body-ad-bottom').slideUp('slow');
        });
	});

</script>


<?php
}
?>

<?php
if($class=='post'){
?>
    <script type="text/javascript">
        $(document).ready(function($) {
            $.post('<?php echo base_url();?>home/hitcount/<?php echo $getnewsby_id['n_id']; ?>');
        });

    </script>
<?php
}
?>

