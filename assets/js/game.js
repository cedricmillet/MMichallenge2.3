
$( document ).ready(function() {

    


    class Jeu {
        constructor(user_id, api_key) {
            
            this.load_user_events();

            this.user_id = user_id;
            this.api_key = api_key;
            this.victoire = false;

            this.skipintro = false;
            this.question_index = -1;
            this.get_user_question_index_and_display();
            this.question = {};
            //this.afficher_question();
            //  log
            console.log( "Jeu initialisé avec succès." );



            

        }

        setStartQuestion(i) {
            i = parseInt(i);
            console.log("question de depart est n°"+i);
            this.question_index = i;
            this.get_question(this.question_index);
        }


        get_user_question_index_and_display() {
            var _this = this;
            $.ajax({
               url : 'api.php', type : 'POST',
               data : 'api_key=' + this.api_key + '&user_id='+this.user_id+'&action=get_question_user_index',
               dataType : 'html',
               success : function(result, statut){
                    _this.setStartQuestion(result);
               },
               error : function(resultat, statut, erreur){
                console.log('erreur AJAX');
               }
            });
        }

        load_user_events() {
            var _this = this;

            $('.reponse').click(function() {
                if(_this.victoire == false) {
                    var index = $(this).data('index');
                    if(_this.question.reponse == index) {
                        _this.bonne_reponse();
                    } else {
                        _this.mauvaise_reponse();
                    }
                }
            });

            $('.restart-game').click(function() {
                if (confirm('Recommencer le jeu depuis le début ?')) {
                    console.log('restart du jeu');
                    $.ajax({
                       url : 'api.php', type : 'POST',
                       data : 'api_key=' + this.api_key + '&user_id='+this.user_id+'&action=restart_question_user_index',
                       dataType : 'html',
                       success : function(result, statut){
                            console.log(result);
                       },
                       error : function(resultat, statut, erreur){
                        console.log('erreur AJAX');
                       }
                    });
                }
            });

        }

        get_question(index) {
            console.log('récupération de la question n°'+index);

            var _this = this;
            $.ajax({
               url : 'api.php',
               type : 'POST', // Le type de la requête HTTP, ici devenu POST
               data : 'api_key=' + this.api_key + '&user_id='+this.user_id+'&action=get_question&question_id='+index, // On fait passer nos variables, exactement comme en GET, au script more_com.php
               dataType : 'json',
               success : function(result, statut){ // success est toujours en place, bien sûr !
                    if(result == 'victoire' || result.texte.length<= 0) {
                        console.log('passage a ecran de victoire !');
                        _this.ecran_victoire();
                        _this.victoire = true;
                    } else {
                        _this.question_index = index;
                        _this.question = result;
                        _this.afficher_question();
                    }
               },
               error : function(resultat, statut, erreur){   console.log('erreur AJAX');     }
            });


            //return {texte: "Quelle couleur pour le cheval blue de henri IV ?", r1: 'blue', r2: 'red', r3: 'green', r4: 'cyan', reponse: 1};
        }

        afficher_question() {
            if(this.question_index==1 && this.skipintro == false) {
                this.goto_introduction();
                return;
            }

            if($('.reponse').css('display') == 'none')
                $('.reponse').slideDown();
            //$('.reponse').css('display', 'block');
            $('.reponse[data-index="1"] p').text(this.question.r1);
            $('.reponse[data-index="2"] p').text(this.question.r2);
            $('.reponse[data-index="3"] p').text(this.question.r3);
            $('.reponse[data-index="4"] p').text(this.question.r4);

            //question
            //$('#text-question').text(this.question.texte);
            new TypeIt('#text-question', {
              strings: this.question.texte,
              speed: 50,
              waitUntilVisible: true
            }).go();
        }

        mauvaise_reponse() {
            console.log('mauvaise reponse');
            this.vibrer_ecran();



        }

        bonne_reponse() {
            console.log('bonne reponse');
            this.clear_gui();
            var _this = this;

            //modifier avancée du joueur
            this.question_index++;

            //enregistrer avancée du joueur

            $.ajax({
               url : 'api.php', type : 'POST',
               data : 'api_key=' + this.api_key + '&user_id='+this.user_id+'&action=set_question_user_index&user_question_index='+this.question_index, // On fait passer nos variables, exactement comme en GET, au script more_com.php
               dataType : 'html',
               success : function(result, statut){
                console.log('mise a jour effectuée, rep:', result);
                    //changer la question
                    _this.get_question(_this.question_index);
               },
               error : function(resultat, statut, erreur){   console.log('erreur AJAX update');     }
            });

            
        }

        ecran_victoire() {
            console.log('victoire detectee!');

            //animation container reponses
            $('#container-reponses').css('transition', 'all 4s ease');
            $('#container-reponses').css('bottom', '-1000px');
            
            //personnage
            $('#container-question').prepend('<div id="container-victoire"><img src="assets/img/personnages/Garcon-CONTENT.png" /><div id="text-victoire"></div></div>');
            setTimeout(function() { 
                $('#container-victoire img').slideDown();

                new TypeIt('#text-victoire', {
                  speed: 50,
                  startDelay: 900
                })
                .type('<h2>VICTOIRE !</h2><br>').pause(450).type('Merci pour ton aide !').go();

            }, 650);     
            
            setTimeout(function() { 
                
                $('#jeu').append('<div id="cadre_partage_jeu">Cette histoire est maintenant terminée. N’hésitez pas à nous faire un retour en suivant ce lien. N’hésitez pas aussi à partager notre petit jeu, afin d de le faire découvrir à vos amis et à leur permettre de découvrir l’IUT MMI de Toulon.</div>');
                $('#cadre_partage_jeu').slideDown();
            }, 5200);
        }

        clear_gui() {
            $('#text-question').html('');
        }

        goto_introduction() {
            if(this.question_index>1) return;
            var _this = this;
            console.log('Lancement introduction au jeu.');

            /*
            new TypeIt('#text-question', {
              strings: "<a class='skipintro'>bienvenue !</a>",
              speed: 50,
              waitUntilVisible: true
            }).go();
            */

            //preparation GUI
            $('.reponse').css('display', 'none');
            $('nav').css('top', '-100px');
            $('#container-reponses').css('bottom', '-1000px');

            $('#container-question').prepend('<div id="intro_perso"><img src="assets/img/personnages/oebkam.png" /></div>');
            $('#intro_perso img').slideDown();

            //$('#text-question').html("Tu ne le sais peut être pas mais tu arrives a une bien triste époque<br>Le Terrible KABEMO a décidé de s'emparer de l’IUT …<br>Il m’est impossible de me balader à l'intérieur librement  !<br><a class='skipintro'>cliquez ici</a>");
            new TypeIt('#text-question', {
              speed: 50,
              startDelay: 900
            })
            .type('…bzz brrr ')
            .pause(250)
            .type('un nouvel arrivant !')
            .pause(1200)
            .delete(99)
            .type('Tout d\'abord bonjour !<br><br>Tu as en face de toi le<br> grand')
            .pause(600)
            .delete(5)
            .type('magistral').pause(200).delete(9).pause(150)
            .type('talentueux Dr.ALi Oebkam !')
            .pause(2000)
            .delete(99)
            .type('Tu ne le sais peut être pas mais tu arrives a une époque')
            .pause(300)
            .delete(6)
            .pause(250)
            .type('bien triste époque !<br><br>')
            .pause(1250)
            .delete(99)
            .type('Le Terrible KABEMO a décidé de s\'emparer de l’IUT …')
            .pause(1250)
            .type('Tu pourrais me faire une faveur ?<br><br>').pause(900).delete(99)
            .type('Va chercher les 4 cartes magnétiques à travers L’IUT.<br><br>').pause(1000)
            .type('Elle permettront de mettre KABEMO hors d’état de nuire et ainsi L’IUT sera SAUVÉ !!!')
            .pause(1250)
            .type('<br><br><a class="skipintro">Oui, j\'accepte</a><br><br><br>')
            .go();

            //user event
            $('#jeu').on('click', '.skipintro', function () {
                console.log('SKIP intro');

                $('#intro_perso').slideUp();
                $('#text-question').html('');
                $('nav').css('transition', 'all 1s ease-out');
                $('#container-reponses').css('transition', 'all 2s ease');

                $('nav').css('top', '0');
                $('#container-reponses').css('bottom', '0');

                setTimeout(function() { 
                    _this.skipintro = true;
                    _this.clear_gui();
                    _this.afficher_question();
                }, 2000);     
                
            });
        }

        vibrer_ecran() {
            $( "body" ).effect( "shake" );
            $( "section" ).effect( "shake" );
        }

    }

    //  LANCEMENT DU JEU
    var usrdata_playerid = $('#usrdata_playerid').val();
    var usrdata_playerapikey = $('#usrdata_playerapikey').val();

    new Jeu(usrdata_playerid, usrdata_playerapikey);    






    // MENU MOBILE
    $('#mobilemenu_icon').click(function() {
        var menu = $('#sidemenu');


        if(menu.hasClass('display'))
            toggleMobileMenu(false);
        else
            toggleMobileMenu(true);
        
    });


    $('.close-sidemenu').click(function() {
        toggleMobileMenu(false);
    });

    function toggleMobileMenu(flag) {
        var menu = $('#sidemenu');
        if(flag) {
            menu.addClass('display');
            menu.removeClass('hide');
        } else {
            menu.addClass('hide');
            menu.removeClass('display');
        }
    }
});