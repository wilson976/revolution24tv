<?php if($class == 'post'){ ?>
<script type="application/ld+json">
  {
    "@context":"https://schema.org",
    "@type":"BreadcrumbList",
    "itemListElement":[
      {
        "@type":"ListItem",
        "position":"1",
        "item":{
          "@id":"https://www.revolution24.tv/",
          "name":"Home"
        }
      },
      {
        "@type":"ListItem",
        "position":"2",
        "item":{
          "@id":"https://www.revolution24.tv/online/<?php echo findWorkbleMenu($getnewsby_id['n_category']); ?>",
          "name":"<?php echo $getcat['m_name']; ?>"
        }
      },
      {
        "@type":"ListItem",
        "position":"3",
        "item":{
          "name" : "<?php echo replace_coma($getnewsby_id['n_head']); ?>",
          "@id":"<?php echo base_url(); ?><?php echo findWorkbleMenu($getnewsby_id['n_category']); ?>/<?php echo str_replace('-', '/', $getnewsby_id['n_date']) ?>/<?php echo $getnewsby_id['n_id']; ?>"
        }
      }
    ]
  }
</script>






    
    
    
    
<script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "NewsArticle",
"url" : "<?php echo base_url(); ?><?php echo findWorkbleMenu($getnewsby_id['n_category']); ?>/<?php echo str_replace('-', '/', $getnewsby_id['n_date']) ?>/<?php echo $getnewsby_id['n_id']; ?>",
"mainEntityOfPage":{
	"@type":"WebPage",
	"name" : "<?php echo $getnewsby_id['n_head'] ?>",
	"@id":"<?php echo base_url(); ?><?php echo findWorkbleMenu($getnewsby_id['n_category']); ?>/<?php echo str_replace('-', '/', $getnewsby_id['n_date']) ?>/<?php echo $getnewsby_id['n_id']; ?>"
},
"headline": "<?php echo $getnewsby_id['n_head'] ?>",
"image": {
	"@type": "ImageObject",
	"url": "<?php echo base_url() . 'assets/news_images/' . str_replace('-', '/', $getnewsby_id['n_date']) . '/' . $getnewsby_id['main_image']; ?>"
},
"datePublished": "<?php echo date('g:i a, j F  Y, D', strtotime($getnewsby_id['start_date'])); ?>",
"dateModified": "<?php echo date('g:i a, j F  Y, D', strtotime($getnewsby_id['edit_time'])); ?>",
"author": {
	"@type": "Person",
	"name": "<?php
	
			if ($getnewsby_id['n_writer'] != '0' AND $getnewsby_id['n_writer'] != NULL) {
				$writers = explode('@', $getnewsby_id['n_writer']);
				$author_location = explode('@', $getnewsby_id['author_location']);
				foreach ($writers as $key => $writer) {
					if($writer == 0)
						continue;
			    	echo findProfileName($writer).',';

				}
			    
			}elseif ($getnewsby_id['n_author'] != 'Not defined') {
				
					if ($getnewsby_id['n_author'] == 'Online Desk')
						echo 'ডেস্ক';
					elseif ($getnewsby_id['n_author'] == 'Press release')
						echo 'প্রেস বিজ্ঞপ্তি';
					elseif ($getnewsby_id['n_author'] == 'Other')
						echo $getnewsby_id['n_author_other'];
					elseif ($getnewsby_id['n_author'] == 'Author name')
						echo $getprofile['p_name'];
			}
			?>"
},
"publisher": {
	"@type": "Organization",
	"name": "banglaedition.com",
	"logo": {
		"@type": "ImageObject",
		"url": "https://www.revolution24.tv/assets/importent_images/logo-revolution24.png"
	}
}
}

</script>
    
    
    


<?php } ?>


<?php if($class == 'online' || $class == 'online-more'){ ?>
<script type="application/ld+json">
  {
    "@context":"https://schema.org",
    "@type":"BreadcrumbList",
    "itemListElement":[
      {
        "@type":"ListItem",
        "position":"1",
        "item":{
          "@id":"https://www.revolution24.tv/",
          "name":"Home"
        }
      },
      {
        "@type":"ListItem",
        "position":"2",
        "item":{
          "@id":"https://www.revolution24.tv/online/<?php echo $getmenu['m_bangla']; ?>",
          "name":"<?php echo $getmenu['m_name']; ?>"
        }
      }
    ]
  }
</script>
<?php } ?>
<?php if($class != 'keywordsearch'){ ?>
<script type="application/ld+json" data-schema="Organization">
	{
	"@context":"https://schema.org",
	"@type":"Organization",
	"name":"বাংলা এডিশন",
	"alternateName":"Bangla Edition",
	"foundingDate":"2024-09-01",
	"url":"https://www.revolution24.tv",
	"sameAs": [
      "https://www.facebook.com/BanglaEdition/",
      "https://www.youtube.com/@banglaedition"
    ],
	"logo": "https://www.revolution24.tv/assets/importent_images/logo-revolution24.png",
	"email":"mailto:info@revolution24.tv",
	"telephone":"+8801787550015",
	"address":{
	"@type":"PostalAddress",
	"description":"বাংলাদেশসহ আন্তর্জাতিক সর্বশেষ সংবাদ শিরোনাম, প্রতিবেদন, খেলা, বিনোদন, চাকরি, রাজনীতি ও বাণিজ্যের বাংলা নিউজ পড়তে ভিজিট করুন রেভুলেশন২৪টিভি।",
	"postalCode":"1230"}
	    
	}
</script>


<script type="application/ld+json" data-schema="Organization">
	{
	"@type":"Website",
	<?php if($class=='post'){ ?>
	    "url":"<?php echo base_url(); ?><?php echo findWorkbleMenu($getnewsby_id['n_category']); ?>/<?php echo str_replace('-', '/', $getnewsby_id['n_date']) ?>/<?php echo $getnewsby_id['n_id']; ?>",
	<?php }else{ ?>
	    "url":"https://www.revolution24.tv/",
	<?php } ?>
	
	"interactivityType":"mixed",
	"name":"বাংলা এডিশন",
	<?php if($class=='post'){ ?>
	    "headline":"<?php echo $getnewsby_id['n_head'] ?>",
	<?php }else{ ?>
	    "headline":"বাংলা এডিশন (Bangla Edition) is the fastest growing Bangla News portal.",
	<?php } ?>
	
	<?php if($class=='post' && $getnewsby_id['meta_keyword'] != ''){ ?>
	    "keywords":"<?php echo $getnewsby_id['meta_keyword']; ?>, <?php $mmenuj = findMenu($getnewsby_id['n_category']); echo $mmenuj['m_keywords']; ?>",
	<?php }else{ ?>
	   "keywords":"বাংলা এডিশন, Bangla Edition, Newspaper, bd newspaper, bangla news, bangla newspaper, bengali newspaper, bangladesh newspaper, bangla newspaper, bangladeshi newspaper, newspaper bangladesh, daily newspaper in bangladesh, daily newspapers of bangladesh, daily newspaper, Daily newspaper, Current News, current news, bengali daily newspaper, daily News , Portal, Bangla, News, Bangladesh, Bangladeshi, Bengali, Culture, Portal Site, Dhaka, Bangladesh News, business news, Business, Media, Dhaka News, World News, National News, Bangladesh Media, Current News, Weather news, Education news, Foreign Education, Higher Education, Sports news, Bangladesh Sports, Bangladesh Politics, Bangladesh Business",
	<?php } ?>
	
	"copyrightHolder": {
		"@type":"NewsMediaOrganization",
		"name":"বাংলা এডিশন"
	},
		"potentialAction": {
			"@type":"SearchAction",
			"target":"https://www.revolution24.tv/home/searchresult?q={q}",
			"query-input":"required name=q"
		},
		"mainEntityOfPage": {   "@type":"WebPage",
			"@id":"https://www.revolution24.tv"
		},
		"@context":"https://schema.org"
}
</script>
<?php } ?>