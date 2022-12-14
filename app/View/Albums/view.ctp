<script type="text/javascript">
	$(document).ready(function() {
		/*
		 *  Simple image gallery. Uses default settings
		 */

		$('.fancybox').fancybox();

		/*
		 *  Different effects
		 */

		// Change title type, overlay closing speed
		$(".fancybox-effects-a").fancybox({
			helpers: {
				title : {
					type : 'outside'
				},
				overlay : {
					speedOut : 0
				}
			}
		});

		// Disable opening and closing animations, change title type
		$(".fancybox-effects-b").fancybox({
			openEffect  : 'none',
			closeEffect	: 'none',

			helpers : {
				title : {
					type : 'over'
				}
			}
		});

		// Set custom style, close if clicked, change title type and overlay color
		$(".fancybox-effects-c").fancybox({
			wrapCSS    : 'fancybox-custom',
			closeClick : true,

			openEffect : 'none',

			helpers : {
				title : {
					type : 'inside'
				},
				overlay : {
					css : {
						'background' : 'rgba(238,238,238,0.85)'
					}
				}
			}
		});

		// Remove padding, set opening and closing animations, close if clicked and disable overlay
		$(".fancybox-effects-d").fancybox({
			padding: 0,

			openEffect : 'elastic',
			openSpeed  : 150,

			closeEffect : 'elastic',
			closeSpeed  : 150,

			closeClick : true,

			helpers : {
				overlay : null
			}
		});

		/*
		 *  Button helper. Disable animations, hide close button, change title type and content
		 */

		$('.fancybox-buttons').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',

			prevEffect : 'none',
			nextEffect : 'none',

			closeBtn  : false,

			helpers : {
				title : {
					type : 'inside'
				},
				buttons	: {}
			},

			afterLoad : function() {
				this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
			}
		});


		/*
		 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
		 */

		$('.fancybox-thumbs').fancybox({
			prevEffect : 'none',
			nextEffect : 'none',

			closeBtn  : false,
			arrows    : false,
			nextClick : true,

			helpers : {
				thumbs : {
					width  : 50,
					height : 50
				}
			}
		});

		/*
		 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
		*/
		$('.fancybox-media')
			.attr('rel', 'media-gallery')
			.fancybox({
				openEffect : 'none',
				closeEffect : 'none',
				prevEffect : 'none',
				nextEffect : 'none',

				arrows : false,
				helpers : {
					media : {},
					buttons : {}
				}
			});

		/*
		 *  Open manually
		 */

		$("#fancybox-manual-a").click(function() {
			$.fancybox.open('1_b.jpg');
		});

		$("#fancybox-manual-b").click(function() {
			$.fancybox.open({
				href : 'iframe.html',
				type : 'iframe',
				padding : 5
			});
		});

		$("#fancybox-manual-c").click(function() {
			$.fancybox.open([
				{
					href : '1_b.jpg',
					title : 'My title'
				}, {
					href : '2_b.jpg',
					title : '2nd title'
				}, {
					href : '3_b.jpg'
				}
			], {
				helpers : {
					thumbs : {
						width: 75,
						height: 50
					}
				}
			});
		});
	});
</script>

<style type="text/css">
	.fancybox-custom .fancybox-skin {
		box-shadow: 0 0 50px #222;
	}
</style>

<h2><?php echo $album['Album']['title']; ?></h2>
<p><?php echo $album['Album']['description']; ?></p>
<?php if(count($album['Photo']) == 0): __('gallery','No albums found.'); else: $photos = $album['Photo']; ?>	
	<ul class="galleryIn">
		<?php foreach($photos as $photo): ?> 
			<li>
				<a class="fancybox-buttons" data-fancybox-group="gallery" href="<?php echo $this->webroot?>img/gallery/large/<?php echo $photo['large']; ?>"> 
					<img src="<?php echo $this->webroot?>img/gallery/thumbnail/<?php echo $photo['thumbnail'] ?>" alt="<?php echo $photo['modified']; ?>" />
					<span>&nbsp;</span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>	

<?php $count = $this->request['paging']['Photo']['pageCount'];?>
<?php if($count >= 2): ?>
<?php if ($pagingBlock = $this->fetch('paging')): ?>
	<?php echo $pagingBlock; ?>
	<?php else: ?>
		<?php if (isset($this->Paginator) && isset($this->request['paging'])): ?>
			<div class="paging">
				<?php echo $this->Paginator->first('< ' . __('first')); ?>
				<?php echo $this->Paginator->prev('< ' . __('prev')); ?>
				<?php echo $this->Paginator->numbers(array('separator'=>'-')); ?>
				<?php echo $this->Paginator->next(__('next') . ' >'); ?>
				<?php echo $this->Paginator->last(__('last') . ' >'); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?> 
<?php endif; ?>