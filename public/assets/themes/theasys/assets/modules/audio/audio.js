/*
 *  Name : Audio
 *  Description : Ability to play background audio and display modal alert whether to play music or not
 *  Version : 0.0.8
*/

THEASYS.theme.autoLoadFunction('audio','init');

THEASYS.theme.modules.audio.initialized = false;

THEASYS.theme.modules.audio.endedPlayingTour = 0;

THEASYS.theme.modules.audio.endedPlayingPanorama = 0;

THEASYS.theme.modules.audio.typePlaying = 'tour';

THEASYS.theme.modules.audio.soundModalEventsLoaded = 0;

THEASYS.theme.modules.audio.playedBackgroundAudio = 0;

THEASYS.theme.modules.audio.soundsMenuClickedState = -1;

THEASYS.theme.modules.audio.playerCurrentState = -1;

THEASYS.theme.modules.audio.wasPlayingWhenForcePause = 0;

THEASYS.theme.modules.audio.loaded = 0;

THEASYS.theme.modules.audio.init = function( ){

    var html = `<audio id="viewer_backgroundAudio" data-type="0" class="hidden"></audio>`;

    THEASYS.theme.appendHtml(html);

    if( !~~THEASYS.renderer.vars.get('options.titles_open_by_default') ){

        this.setAudio();

    }

    this.initialized = true;

    THEASYS.theme.initialized('audio');

    document.getElementById('viewer_backgroundAudio').addEventListener('ended', function(){

        var type = THEASYS.theme.modules.audio.getType();

        if( type === 'tour' ){

            THEASYS.theme.modules.audio.endedPlayingTour = 1;

        } else {

            THEASYS.theme.modules.audio.endedPlayingPanorama = 1;

        }

        $('#viewer_menu').find('.toggle-sounds').removeClass('selected');


    });

    THEASYS.renderer.event.on('panoramaToScene',function( ){

        var type = THEASYS.theme.modules.audio.getType();

        if( type === 'panorama' && THEASYS.theme.modules.audio.typePlaying === 'tour' ){

            THEASYS.theme.modules.audio.endedPlayingTour = 1;

        }

        var autoplay = false;

        if( type === 'tour' && THEASYS.theme.modules.audio.typePlaying === 'tour' ){


        } else {

            autoplay = THEASYS.theme.modules.audio.setAudio();

        }

        if( THEASYS.theme.modules.audio.endedPlayingTour && type === 'tour' ){

            return false;

        }

        if( !THEASYS.theme.modules.audio.soundsMenuClickedState ){

            return false;

        }

        if( autoplay ){

            THEASYS.theme.modules.audio.play();

        }

    });

};

THEASYS.theme.modules.audio.listenToEdits = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'background_sound_cao':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.background_sound_cao',value);

                if( !value ){

                    THEASYS.fn.clear_cao();

                } else {

                    var action = {

                        t : 'dip',
                        cao : value,
                        status : 1,
                        type : 'display_info_panel',

                    };

                    THEASYS.fn.apply_cao(action);

                }

            break;

            case'background_sound_active_on_load':

                this.toggle(+obj[k]);

                THEASYS.renderer.vars.set('options.background_sound_active_on_load',parseInt(obj[k],10));

            break;

            case'background_sound_delay':

                THEASYS.renderer.vars.set('options.background_sound_delay',parseInt(obj[k],10));

            break;

            case'background_sound_loop':

                THEASYS.renderer.vars.set('options.background_sound_loop',+obj[k]);

                this.setLoop();

            break;

        }

    }

};

THEASYS.theme.modules.audio.forcePause = function( ){

    var viewer_backgroundAudioPlayer = document.getElementById('viewer_backgroundAudio');

    var playing = !viewer_backgroundAudioPlayer.paused && !viewer_backgroundAudioPlayer.ended && 0 < viewer_backgroundAudioPlayer.currentTime;

    this.wasPlayingWhenForcePause = playing;

    if( playing ){

        viewer_backgroundAudioPlayer.pause();

        this.forcedPaused = 1;

        $('#viewer_menu').find('.toggle-sounds').removeClass('selected');

    }

}

THEASYS.theme.modules.audio.resumeBackgroundSound = function( ){

    if( this.soundsMenuClickedState > -1 && this.wasPlayingWhenForcePause ){

        var viewer_backgroundAudioPlayer = document.getElementById('viewer_backgroundAudio');

        var playing = !viewer_backgroundAudioPlayer.paused && !viewer_backgroundAudioPlayer.ended && 0 < viewer_backgroundAudioPlayer.currentTime;

        if( !playing ){

            this.play();

        }

    }

}

THEASYS.theme.modules.audio.loadSoundModal = function( ){

    if( this.soundModalEventsLoaded || this.playedBackgroundAudio ){

        return false;

    }

    THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled', true);

    setTimeout(function () {

        THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled', true);

    },100);

    var options = THEASYS.renderer.vars.get('options');

    var bsa_text = 'background_sound_autoplay_text' in options ? options.background_sound_autoplay_text : 'Enable Audio?';

    var bsa_yes = 'background_sound_autoplay_yes' in options ? options.background_sound_autoplay_yes : 'YES';

    var bsa_no = 'background_sound_autoplay_no' in options ? options.background_sound_autoplay_no : 'NO';

    var html = `

    <div id="panorama-sound">
        <div id="panorama-sound-content">
            <div>
                ${bsa_text}
            </div>
            <div class="audio-border"></div>
            <div>
                <button id="panorama-sound-content-yes" class="btn btn-default">${bsa_yes}</button>
                <button id="panorama-sound-content-no" class="btn btn-default">${bsa_no}</button>
            </div>
        </div>
    </div>

    `;

    var html_content = html;

    var html = `
        <a class="display_audio" data-fancybox="audio_popup" data-src="#audio_popup" href="javascript:;"></a>
        <div id="audio_popup">${html_content}</div>
    `;

    $('#actions_html_container').html(html);

    $(".display_audio").fancybox({
        infobar: false,
        smallBtn: true,
        hash: false,
        onActivate: function(instance) {

            var options = THEASYS.renderer.vars.get('options');

            var action = {

                t : 'dip',
                cao : ('background_sound_cao' in options ? options.background_sound_cao : ''),
                status : 1,
                type : 'display_info_panel',

            };

            THEASYS.fn.apply_cao(action,instance.id);

        },
        afterClose: function(instance) {

            THEASYS.fn.clear_cao(instance.id);

        },

    });

    $('#actions_html_container').find('a.display_audio').simulateClick('click');

    this.loadSoundModalEvents();

};

THEASYS.theme.modules.audio.loadSoundModalEvents = function( ){

    if( !this.soundModalEventsLoaded ){

        $(document).on('click','#panorama-sound-content-yes',function(){

            THEASYS.theme.modules.audio.toggle();

            var viewer_menu = $('#viewer_menu');

            viewer_menu.find('.toggle-sounds').addClass('selected');

            $.fancybox.close();

            THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled', false);

        });

        $(document).on('click','#panorama-sound-content-no',function(){

            $.fancybox.close();

            THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled', false);

            //so not to start sound when go to other panorama
            THEASYS.theme.modules.audio.soundsMenuClickedState = 0;

        });

        this.soundModalEventsLoaded = 1;

    }

};

THEASYS.theme.modules.audio.play = function( ){

    var viewer_backgroundAudioPlayer = document.getElementById('viewer_backgroundAudio');

    var delay = this.getDelay();

    if( delay > 0 ){

        $('#viewer_menu').find('.toggle-sounds').addClass('selected');

        setTimeout(function() {

            var promise = viewer_backgroundAudioPlayer.play();

            if (promise !== null){

                promise.catch(() => { viewer_backgroundAudioPlayer.play(); });

            }

            if(promise !== undefined){

                promise.then(_ => {

                    THEASYS.theme.modules.audio.endedPlaying = 0;

                    THEASYS.theme.modules.audio.playedBackgroundAudio = 1;

                }).catch(error => {


                });
            }

        }, delay * 1000);

    } else {

        $('#viewer_menu').find('.toggle-sounds').addClass('selected');

        var promise = viewer_backgroundAudioPlayer.play();

        if( promise !== undefined ){

            promise.then(_ => {

                THEASYS.theme.modules.audio.endedPlaying = 0;

                THEASYS.theme.modules.audio.playedBackgroundAudio = 1;

            }).catch(error => {

            });

        }

    }

}

THEASYS.theme.modules.audio.toggle = function( ){

    var viewer_backgroundAudioPlayer = document.getElementById('viewer_backgroundAudio');

    var playing = !viewer_backgroundAudioPlayer.paused && !viewer_backgroundAudioPlayer.ended && 0 < viewer_backgroundAudioPlayer.currentTime;

    this.wasPlayingWhenForcePause = 0;

    if( playing ){

        viewer_backgroundAudioPlayer.pause();

        this.soundsMenuClickedState = 0;

        $('#viewer_menu').find('.toggle-sounds').removeClass('selected');

    } else {

        this.soundsMenuClickedState = 1;

        this.play();

    }

};


THEASYS.theme.modules.audio.setLoop = function( loop ){

    var viewer_backgroundAudio = document.getElementById('viewer_backgroundAudio');

    if( ~~loop ){

        viewer_backgroundAudio.loop = true;

    } else {

        viewer_backgroundAudio.loop = false;

    }

};

THEASYS.theme.modules.audio.getDelay = function( ){

    var options = THEASYS.renderer.vars.get('options');
    var id = THEASYS.renderer.vars.get('id');
    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');
    var user_random_uid = THEASYS.renderer.vars.get('user_random_uid');

    var viewer_backgroundAudio = document.getElementById('viewer_backgroundAudio');

    var src = '';
    var loop = 0;
    var delay = 0;
    var autoplay = 0;

    if( ~~options.background_sound_force ){

        if( 'audio' in THEASYS.cache.obj.tours[tour_rnd].tour ){

            var tour_audio = JSON.parse(THEASYS.cache.obj.tours[tour_rnd].tour.audio);

            if( tour_audio && 'file' in tour_audio && tour_audio.file !== '' ){

                delay = ~~options.background_sound_delay;

            }

        }

    } else {

      var loaded = false;

      if( id in THEASYS.cache.obj.tours[tour_rnd].panoramas ){

            if( 'audio' in THEASYS.cache.obj.tours[tour_rnd].panoramas[id] ){

                if( THEASYS.cache.obj.tours[tour_rnd].panoramas[id].audio ){

                    delay = ~~THEASYS.cache.obj.tours[tour_rnd].panoramas[id].audio.delay;

                    loaded = 1;

                }

            }

        }

        if( !loaded ){

            if( 'audio' in THEASYS.cache.obj.tours[tour_rnd].tour ){

                var tour_audio = JSON.parse(THEASYS.cache.obj.tours[tour_rnd].tour.audio);

                if( tour_audio && 'file' in tour_audio && tour_audio.file !== '' ){

                    delay = ~~options.background_sound_delay;

                }

            }

        }

    }

    return delay;

};

THEASYS.theme.modules.audio.getType = function( ){

    var options = THEASYS.renderer.vars.get('options');
    var id = THEASYS.renderer.vars.get('id');
    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

    var type = 'tour';

    if( ~~options.background_sound_force ){


    } else {

        if( id in THEASYS.cache.obj.tours[tour_rnd].panoramas ){

            if( 'audio' in THEASYS.cache.obj.tours[tour_rnd].panoramas[id] ){

                if( THEASYS.cache.obj.tours[tour_rnd].panoramas[id].audio ){

                    type = 'panorama';

                }

            }

        }

    }

    return type;

}

THEASYS.theme.modules.audio.setAudio = function( ){

    var options = THEASYS.renderer.vars.get('options');
    var id = THEASYS.renderer.vars.get('id');
    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');
    var user_random_uid = THEASYS.renderer.vars.get('user_random_uid');

    this.typePlaying = this.getType();

    var viewer_backgroundAudio = document.getElementById('viewer_backgroundAudio');

    var src = '';
    var loop = 0;
    var delay = 0;
    var autoplay = 0;

    var viewer_menu = $('#viewer_menu');

    viewer_menu.find('.toggle-sounds').addClass('hidden');

    var ableToPlay = false;

    var autoStart = false;

    var tour_audio = JSON.parse(THEASYS.cache.obj.tours[tour_rnd].tour.audio);

    var background_sound_force = ~~options.background_sound_force;

    if( tour_audio && 'file' in tour_audio && tour_audio.file !== '' ){

        //background_sound_force = 0;

    } else {

        background_sound_force = 0;

    }

    if( background_sound_force ){

        var type = ~~viewer_backgroundAudio.getAttribute('data-type');

        if( type === 1 ){

            viewer_backgroundAudio.pause();

            type = 0;

        }

        var playing = !viewer_backgroundAudio.paused && !viewer_backgroundAudio.ended && 0 < viewer_backgroundAudio.currentTime;

        if( !playing ){

            if( 'audio' in THEASYS.cache.obj.tours[tour_rnd].tour ){

                var tour_audio = JSON.parse(THEASYS.cache.obj.tours[tour_rnd].tour.audio);

                if( tour_audio && 'file' in tour_audio && tour_audio.file !== '' ){

                    viewer_backgroundAudio.setAttribute('src',vars.paths.media+'/'+user_random_uid+'/'+tour_rnd+'/tour_sound/'+tour_audio.file);

                    viewer_backgroundAudio.setAttribute('data-type',0);

                    this.setLoop(~~options.background_sound_loop);

                    ableToPlay = true;

                    viewer_menu.find('.toggle-sounds').removeClass('selected');

                    if( ~~options.background_sound_active_on_load ){

                        autoStart = true;

                    }

                    this.showSoundsMenu();

                }

            }

        } else {

            this.showSoundsMenu();

            viewer_menu.find('.toggle-sounds').addClass('selected');

        }

    } else {

        var loaded = 0;

        if( id in THEASYS.cache.obj.tours[tour_rnd].panoramas ){

            if( 'audio' in THEASYS.cache.obj.tours[tour_rnd].panoramas[id] ){

                if( THEASYS.cache.obj.tours[tour_rnd].panoramas[id].audio ){

                    src = vars.paths.media+'/'+user_random_uid+'/'+tour_rnd+'/panoramas_sound/'+THEASYS.cache.obj.tours[tour_rnd].panoramas[id].audio.file;
                    loop = ~~THEASYS.cache.obj.tours[tour_rnd].panoramas[id].audio.loop;
                    delay = ~~THEASYS.cache.obj.tours[tour_rnd].panoramas[id].audio.delay;
                    autoplay = ~~THEASYS.cache.obj.tours[tour_rnd].panoramas[id].audio.autoplay;

                    viewer_backgroundAudio.setAttribute('src',src);
                    viewer_backgroundAudio.setAttribute('data-type',1);

                    loaded = 1;

                    this.setLoop(loop);

                    this.showSoundsMenu();

                    ableToPlay = true;

                    if( autoplay ){

                        autoStart = true;

                    } else {

                        viewer_menu.find('.toggle-sounds').removeClass('selected');

                    }

                }

            }

        }

        if( !loaded ){

            var type = ~~viewer_backgroundAudio.getAttribute('data-type');

            if( type === 1 ){

                viewer_backgroundAudio.pause();

                type = 0;

            }

            var playing = !viewer_backgroundAudio.paused && !viewer_backgroundAudio.ended && 0 < viewer_backgroundAudio.currentTime;

            if( !playing ){

                if( 'audio' in THEASYS.cache.obj.tours[tour_rnd].tour ){

                    var tour_audio = JSON.parse(THEASYS.cache.obj.tours[tour_rnd].tour.audio);

                    if( tour_audio && 'file' in tour_audio && tour_audio.file !== '' ){

                        viewer_backgroundAudio.setAttribute('src',vars.paths.media+'/'+user_random_uid+'/'+tour_rnd+'/tour_sound/'+tour_audio.file);

                        viewer_backgroundAudio.setAttribute('data-type',0);

                        this.setLoop(~~options.background_sound_loop);

                        viewer_menu.find('.toggle-sounds').removeClass('selected');

                        ableToPlay = true;

                        if( ~~options.background_sound_active_on_load ){

                            autoStart = true;

                        }

                        this.showSoundsMenu();

                    }

                }

            } else {

                this.showSoundsMenu();

                viewer_menu.find('.toggle-sounds').addClass('selected');

            }

        }

    }

    if( ableToPlay && autoStart ){

        if( !this.soundModalEventsLoaded ){

            var type = THEASYS.theme.modules.audio.getType();

            var loadedTwice = THEASYS.renderer.vars.get('loadedTwice');

            if( loadedTwice ){


            } else {

                this.loadSoundModal();

            }

        }

    }

    return autoStart;

};

THEASYS.theme.modules.audio.showSoundsMenu = function(){

    var background_sound = THEASYS.renderer.vars.get('options.background_sound');

    if( parseInt(background_sound,10) ){

        $('#viewer_menu').find('.toggle-sounds').removeClass('hidden');

    }

}
