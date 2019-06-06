
	//	MOBILE MENU
	$('.mobile-menu-toggle-icon').click(function() {
		var menu = $('#mobile-menu');
		if(menu.hasClass('show'))
			menu.removeClass('show');
		else
			menu.addClass('show');
	});






	class Jeu {
		constructor() {
			this.questions = this.getQuestionsFromDB();
			this.indexQuestion = 0;
			this.maxQuestions = this.questions.length;

			//init
			this.loadQuestion();

			this.mouseEvents();
		}

		mouseEvents() {
			var _this = this;
			$('div.reponse').click(function() {
				var i = $(this).data('index');
					_this.indexQuestion++;
					_this.loadQuestion();
				
			});
		}

		getQuestionsFromDB() {
			var q = { 

					0: { 	
							id: 0,
							questionString: "Quelle est la couleur du mur Nord en FA3 ?",
							answers: {0: 'Bleu, le ciel de provence', 1: 'Rouge, le sang des etudiants', 2: 'Vert, l\'espoir', 3: 'Jaune'},
							validAnswer: 2,
							personnageID: 1
					 	},
				 	1: { 	
							id: 0,
							questionString: "Quel est le premier langage de prog a avoir existé ?",
							answers: {0: 'Java', 1: 'C', 2: 'HTML', 3: 'Fortran'},
							validAnswer: 2,
							personnageID: 1
				 		}

					};
			return q;
		}



		loadQuestion() {
			var index = this.indexQuestion;
			
			$('.question-title').html('Question n°'+(index+1));
			
			//	Question string
			this.setPersonnageText(this.questions[index].questionString);

			//	Reponses
			for(var i=1; i<=4; i++) {
				$('div.reponse[data-index="'+i+'"]').html(this.questions[index].answers[i-1]);
			}
			
		}

		setPersonnageText(txt="N/A", spped=50) {
			$('.question').html('');
			const instance = new TypeIt('.question', {
				strings: [txt],
				speed: spped,
				waitUntilVisible: true
				//-- Other options...
			}).go();
		}

	}







function shakeScreen() {
	$( "body" ).effect( "shake" );
	$( "section" ).effect( "shake" );
}


//FULLSCREEN
/*
document.addEventListener("keypress", function(e) {
  if (e.keyCode === 13) {
    toggleFullScreen();
  }
}, false);
*/

function toggleFullScreen() {
  if (!document.fullscreenElement) {
      document.documentElement.requestFullscreen();
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen(); 
    }
  }
}