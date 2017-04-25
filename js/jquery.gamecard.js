

(function($) {

    var SnetGamecard = function(element, options) {


        this.run = function(){

            $(document).on("SN.ScoreData.event.REFRESH_ALL", null, this, this.scoresData_RefreshAll_handler);
        };


        this.update = function (gameScoreDataObj, snetGamecardObj){

            var gamecode = gameScoreDataObj.gamecode;

            // If the gamecard for this game exists on the page.
            // Updating only score and game status. No need to update teams.
            if($("#game_card_container_" + gamecode).length) {

                // GAME SCORE
                var oldTeam1Score = $("#game_card_container_" + gamecode).find("[class*=team-container-1]").find("[class^=scores-team-score]").html();
                var oldTeam2Score = $("#game_card_container_" + gamecode).find("[class*=team-container-2]").find("[class^=scores-team-score]").html();
                var newTeam1Score = gameScoreDataObj.team1.score_display;
                var newTeam2Score = gameScoreDataObj.team2.score_display;

                var game_status_display = '';

                if ( !isNaN(oldTeam1Score) && !isNaN(oldTeam2Score) && !isNaN(newTeam1Score) && !isNaN(newTeam2Score) && ( parseInt(oldTeam1Score) != parseInt(newTeam1Score) || parseInt(oldTeam2Score) != parseInt(newTeam2Score) ) ){

                    $("#game_card_container_" + gamecode).find("[class*=team-container-1]").find("[class^=scores-team-score]").html(newTeam1Score);
                    $("#game_card_container_" + gamecode).find("[class*=team-container-2]").find("[class^=scores-team-score]").html(newTeam2Score);

                    this.gamecardScore_Updated_handler(gameScoreDataObj);
                }


                // GAME STATUS
                var game_status              = gameScoreDataObj.game_status.toLowerCase();
                var game_full_date           = gameScoreDataObj.clock.dateObj;
                var game_full_date_formatted = '';

                if (game_status == "pre-game" && gameScoreDataObj.tba != false) {

                    if(game_full_date && $.datepicker.formatDate('m/d/y', game_full_date)  != $.datepicker.formatDate('m/d/y', new Date())){

                        game_full_date_formatted = $.datepicker.formatDate('M d', game_full_date); // eg. Nov 27
                        game_status_display = "TBD<br>"+game_full_date_formatted;
                    }
                    else{
                        game_status_display = "TBD";

                    }
                }
                else if (gameScoreDataObj.game_status.toLowerCase() == "pre-game") {

                    if(game_full_date && $.datepicker.formatDate('m/d/y', game_full_date)  != $.datepicker.formatDate('m/d/y', new Date())){

                        game_status_display = SN.displayLocalGameTime(game_full_date, true);
                    }
                    else{
                        game_status_display = SN.displayLocalGameTime(game_full_date, false);
                    }
                }
                else {

                    if(game_status == 'In-progress' || game_status == 'in-progress'){

                        game_status_display = gameScoreDataObj.clock.display.split(" ");
                        game_status_display = game_status_display[0] +"<br><strong>"+game_status_display[1]+"</strong>";

                        if(gameScoreDataObj.clock.period_status.indexOf("End") != -1 ){
                            game_status_display = "<strong>"+gameScoreDataObj.clock.display.toUpperCase()+"</strong>";
                        }
                    }
                    else{ // FINAL

                        game_status_display = game_status.toUpperCase();

                    }
                }

                var old_game_status_display = $("#game_card_container_" + gamecode).find("[class*=scores-game-status]").find("[class^=game-status]").html();
                if(old_game_status_display != game_status_display) {
                    $("#game_card_container_" + gamecode).find("[class*=scores-game-status]").find("[class^=game-status]").html(game_status_display);
                    this.gamecardStatus_Updated_handler(gameScoreDataObj);

                }
            }

        };

        /******* EVENT HANDLERS *********/
        this.gamecardStatus_Updated_handler = function (gameScoreDataObj) {

            console.log("SN.Gamecard.STATUS_UPDATED!!");

            var gamecode = gameScoreDataObj.gamecode;
            var normalFlashOverlay =  $("#game_card_container_" + gamecode);
            normalFlashOverlay.fadeOut('slow').fadeIn('slow');
        };


        this.gamecardScore_Updated_handler = function (gameScoreDataObj) {

            var gamecode = gameScoreDataObj.gamecode;

            $("#game_card_container_" + gamecode).find("[class*=team-container-1]").find("[class^=scores-team-score]").removeClass("score-winner");
            $("#game_card_container_" + gamecode).find("[class*=team-container-1]").find("[class^=scores-team-score]").removeClass("score-loser");
            $("#game_card_container_" + gamecode).find("[class*=team-container-1]").find("[class^=scores-team-score]").next().removeClass("scores-team-chevron");

            $("#game_card_container_" + gamecode).find("[class*=team-container-2]").find("[class^=scores-team-score]").removeClass("score-winner");
            $("#game_card_container_" + gamecode).find("[class*=team-container-2]").find("[class^=scores-team-score]").removeClass("score-loser");
            $("#game_card_container_" + gamecode).find("[class*=team-container-2]").find("[class^=scores-team-score]").next().removeClass("scores-team-chevron");

            var newTeam1Score = gameScoreDataObj.team1.score_display;
            var newTeam2Score = gameScoreDataObj.team2.score_display;
            var game_win_score = Math.max(newTeam1Score, newTeam2Score);

            if(newTeam1Score == newTeam2Score){
                $("#game_card_container_" + gamecode).find("[class*=team-container-1]").find("[class^=scores-team-score]").addClass("score-in-progress");
                $("#game_card_container_" + gamecode).find("[class*=team-container-2]").find("[class^=scores-team-score]").addClass("score-in-progress");
            }
            else if(newTeam1Score == game_win_score){
                $("#game_card_container_" + gamecode).find("[class*=team-container-1]").find("[class^=scores-team-score]").addClass("score-winner");
                $("#game_card_container_" + gamecode).find("[class*=team-container-1]").find("[class^=scores-team-score]").next().addClass("scores-team-chevron");
                $("#game_card_container_" + gamecode).find("[class*=team-container-2]").find("[class^=scores-team-score]").addClass("score-loser");

            }
            else if(newTeam2Score == game_win_score){
                $("#game_card_container_" + gamecode).find("[class*=team-container-2]").find("[class^=scores-team-score]").addClass("score-winner");
                $("#game_card_container_" + gamecode).find("[class*=team-container-2]").find("[class^=scores-team-score]").next().addClass("scores-team-chevron");
                $("#game_card_container_" + gamecode).find("[class*=team-container-1]").find("[class^=scores-team-score]").addClass("score-loser");
            }


            var normalFlashOverlay =  $("#game_card_container_" + gamecode);
            normalFlashOverlay.fadeOut('slow').fadeIn('slow');

            console.log("SN.Gamecard.SCORE_UPDATED!!");

        };


        this.scoresData_RefreshAll_handler = function(event) {

            var snetScoresDataObj = $(document).data("snetScoresData");
            console.log(snetScoresDataObj);
            var gamecodes         = snetScoresDataObj.scoresData;
            var snetGamecardObj   = $(document).data("snetGamecard");

            for(var gamecode in gamecodes){

                if($("#game_card_container_" + gamecode).length) {
                    $(document).on("SN.ScoreData.event.GAME_UPDATED." + gamecode, null, this, snetGamecardObj.scoresData_GameUpdated_handler);
                }
            }
        };

        this.scoresData_GameUpdated_handler = function (event, gameScoreDataObj) {

            var snetGamecardObj = $(document).data("snetGamecard");
            snetGamecardObj.update(gameScoreDataObj, snetGamecardObj);
        };

    };




    $.fn.snetGamecard = function(options) {

        return this.each(function() {
            // Return early if this element already has a plugin instance
            if ($(this).data('snetGamecard')) return;

            // pass options to plugin constructor
            var snetGamecard = new SnetGamecard(this, options);
            $(this).data('snetGamecard', snetGamecard);
            snetGamecard.run($(this));

        });
    };



}(jQuery));
