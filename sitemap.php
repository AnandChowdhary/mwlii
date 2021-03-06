<?php
	header("Content-type: text/xml");
	include "database.php";
	$startups = DB::query("SELECT name, slug FROM startups");
	$cities = DB::query("SELECT city FROM startups GROUP BY city");
	$industries = DB::query("SELECT industry FROM startups GROUP BY industry");
	$tagInfo = DB::query("SELECT tag1 FROM startups");
	$tagsArray = [];
	foreach ($tagInfo as $tags) {
		$tagK = json_decode($tags["tag1"]);
		foreach ($tagK as $ta) {;
			if (!in_array($ta, $tagsArray)) {
				array_push($tagsArray, $ta);
			}
		}
	}
	$siteURL = "https://madewithlove.org.in";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url><loc><?php echo $siteURL; ?></loc></url>
	<url><loc><?php echo $siteURL; ?>/badges</loc></url>
	<url><loc><?php echo $siteURL; ?>/recover</loc></url>
	<url><loc><?php echo $siteURL; ?>/login</loc></url>
	<url><loc><?php echo $siteURL; ?>/register</loc></url>
	<url><loc><?php echo $siteURL; ?>/about</loc></url>
	<url><loc><?php echo $siteURL; ?>/a11y</loc></url>
	<url><loc><?php echo $siteURL; ?>/terms</loc></url>
	<url><loc><?php echo $siteURL; ?>/cookies</loc></url>
	<url><loc><?php echo $siteURL; ?>/privacy</loc></url>
	<url><loc><?php echo $siteURL; ?>/responsibilities</loc></url>
	<url><loc><?php echo $siteURL; ?>/about</loc></url>
	<?php foreach ($startups as $startup) { ?>
	<url><loc><?php echo $siteURL; ?>/startup/<?php echo $startup["slug"]; ?></loc></url>
	<url><loc><?php echo $siteURL; ?>/startup/<?php echo $startup["slug"]; ?>/about</loc></url>
	<url><loc><?php echo $siteURL; ?>/startup/<?php echo $startup["slug"]; ?>/founders</loc></url>
	<url><loc><?php echo $siteURL; ?>/startup/<?php echo $startup["slug"]; ?>/news</loc></url>
	<url><loc><?php echo $siteURL; ?>/startup/<?php echo $startup["slug"]; ?>/badges</loc></url>
	<url><loc><?php echo $siteURL; ?>/startup/<?php echo $startup["slug"]; ?>/lists</loc></url>
	<?php } ?>
	<url><loc><?php echo $siteURL; ?>/cities</loc></url>
	<?php foreach ($cities as $city) { ?>
	<url><loc><?php echo $siteURL; ?>/city/<?php echo slugify($city["city"]); ?></loc></url>
	<?php } ?>
	<url><loc><?php echo $siteURL; ?>/industries</loc></url>
	<?php foreach ($industries as $industry) { ?>
	<url><loc><?php echo $siteURL; ?>/industry/<?php echo slugify($industry["industry"]); ?></loc></url>
	<?php } ?>
	<?php foreach ($tagsArray as $tag) { ?>
	<url><loc><?php echo $siteURL; ?>/startups/<?php echo urlencode($tag); ?></loc></url>
	<?php } ?>
	<?php foreach (DB::query("SELECT username as a FROM users") as $profile) { if ($profile["a"]) { ?>
	<url><loc><?php echo $siteURL; ?>/profile/<?php echo urlencode($profile["a"]); ?></loc></url>
	<url><loc><?php echo $siteURL; ?>/profile/<?php echo urlencode($profile["a"]); ?>/startups</loc></url>
	<url><loc><?php echo $siteURL; ?>/profile/<?php echo urlencode($profile["a"]); ?>/education</loc></url>
	<?php } } ?>
	<?php foreach (DB::query("SELECT university1 as a FROM users GROUP BY university1") as $institute) { if ($institute["a"]) { ?>
	<url><loc><?php echo $siteURL; ?>/institute/<?php echo urlencode($institute["a"]); ?></loc></url>
	<?php } } ?>
	<?php foreach (DB::query("SELECT university2 as a FROM users GROUP BY university2") as $institute) { if ($institute["a"]) { ?>
	<url><loc><?php echo $siteURL; ?>/institute/<?php echo urlencode($institute["a"]); ?></loc></url>
	<?php } } ?>
	<?php foreach (DB::query("SELECT university3 as a FROM users GROUP BY university3") as $institute) { if ($institute["a"]) { ?>
	<url><loc><?php echo $siteURL; ?>/institute/<?php echo urlencode($institute["a"]); ?></loc></url>
	<?php } } ?>
</urlset>