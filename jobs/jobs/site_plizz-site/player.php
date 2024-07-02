<script type="text/javascript">
$(document).ready(function(){
		
	$("#jquery_jplayer_1").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
				m4v		: "http://www.jplayer.org/video/m4v/Big_Buck_Bunny_Trailer.m4v",
				ogv		: "http://www.jplayer.org/video/ogv/Big_Buck_Bunny_Trailer.ogv",
				webmv	: "http://www.jplayer.org/video/webm/Big_Buck_Bunny_Trailer.webm",
			});
		},
		swfPath: "js",
		supplied: "webmv, ogv, m4v",
		size: {
			width: "590px",
			height: "360px",
			cssClass: "jp-video-360p"
		}
	});
		
});
</script>

<div id="player">
    
    <div id="jp_container_1" class="jp-video jp-video-360p">
        <div id="jquery_jplayer_1" class="jp-jplayer"></div>
        <div class="jp-gui">
            <div class="jp-interface">
                <div class="jp-controls-holder">
                    <a href="javascript:;" class="jp-play" tabindex="1">play</a>
                    <a href="javascript:;" class="jp-pause" tabindex="1">pause</a>
                    <span class="separator sep-1"></span>
                    <div class="jp-progress">
                        <div class="jp-seek-bar">
                            <div class="jp-play-bar"><span></span></div>
                        </div>
                    </div>
                    <div class="jp-current-time"></div>
                    <span class="time-sep">/</span>
                    <div class="jp-duration"></div>
                    <span class="separator sep-2"></span>
                    <a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a>
                    <a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a>
                    <div class="jp-volume-bar">
                        <div class="jp-volume-bar-value"><span class="handle"></span></div>
                    </div>
                    <span class="separator sep-2"></span>
                    <a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a>
                    <a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen">restore screen</a>
                </div>
            </div>
        </div>
        <div class="jp-no-solution">
            <span>Update Required</span>
            Here's a message which will appear if the video isn't supported. A Flash alternative can be used here if you fancy it.
        </div>
    </div>
    
    <div id="comments">
    
    </div>
    
</div>