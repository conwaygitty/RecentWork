<?php
/*
 * Player Tooltip Goalie View
 */
?>
<?php
    if ( strtolower($player->birth_country) == "canada" || strtolower($player->birth_country) == "united states" ) {
        $birthplace = $player->birth_city .', ' . $player->birth_state_abbrev;
    } else {
        $birthplace = $player->birth_city .', ' . $player->birth_country_abbrev;
    }
?>
<div class='tooltip-main-container'>

    <div class='player-info-container <?php echo 'nhl-tooltip-' . strtolower($player->team_short_name); ?>'>
        <img class='team-logo' src='<?=$player->team_image?>'>
        <div class='first-name'><?=$player->first_name?></div>
        <div class='last-name'><?=$player->last_name?></div>
        <div class='player-position'><?=$player->position?></div>
        <div class='player-birthplace'><?=$birthplace?></div>

        <div class='player-photo'>
            <div class='player-photo-inner'>
            	<img class='img-responsive' src='<?=$player->image_url?>'/>
            </div>
        </div>

    </div>

    <div class='player-stats <?php echo 'nhl-tooltip-' . strtolower($player->team_short_name); ?>'>
        <div class='player-stats-row'>
            <div class='statistic text-center'>
                <div class='type'>W</div>
                <div class='value'><?=$player->season_stats->wins?></div>
            </div>
            <div class='statistic text-center'>
                <div class='type'>L</div>
                <div class='value'><?=$player->season_stats->losses?></div>
            </div>
            <div class='statistic text-center'>
                <div class='type'>OTL</div>
                <div class='value'><?=$player->season_stats->overtime_losses?></div>
            </div>
        </div>
        <div class='player-stats-row'>
            <div class='statistic text-center'>
                <div class='type'>SO</div>
                <div class='value'><?=$player->season_stats->shutouts?></div>
            </div>
            <div class='statistic text-center'>
                <div class='type'>GAA</div>
                <div class='value'><?=$player->season_stats->goals_against_average?></div>
            </div>
            <div class='statistic text-center'>
                <div class='type'>SV%</div>
                <div class='value'><?=$player->season_stats->save_percentage?></div>
            </div>
        </div>
    </div>

    <div class='player-status-container'>
        <?php if (strtolower($player->injury_status) == null) { ?>
            <div class='status-card-active-height'>
                <div class='status-active'>
                    <div class="status-container">Status: <span class="active">Active</span></div><br/>
                </div>
        <?php } else { ?>
            <div class='status-card-out-height'>
                <div class='status-out'>
                    <div class="status-container">Status: <span class="out"><?=$player->injury_status?></span></div>
                    <div class="injury-container">Injury: <span class="injury-desc"><?=$player->injury_type?></span></div>
                </div>
        <?php } ?>
            <div class='clearfix'></div>
            <div class='full-profile'><a class='tooltip-player-link' target='_blank' data-player='<?=$player->player_id?>' href='<?=$player->profile_page?>'>Full Profile</a></div>
        </div>
    </div>

</div>