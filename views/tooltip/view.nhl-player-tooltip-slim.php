<?php
/*
 * Player Tooltip Skater View
 */
?>
<?php
    if ( strtolower($player->birth_country) == "canada" || strtolower($player->birth_country) == "united states" ) {
        $birthplace = $player->birth_city .', ' . $player->birth_state_abbrev;
    } else {
        $birthplace = $player->birth_city .', ' . $player->birth_country_abbrev;
    }
	$shooting_pct = sprintf('%.01f', $player->season_stats->shooting_percentage);
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
                <div class='type'>gp</div>
                <div class='value'><?=$player->season_stats->games_played?></div>
            </div>
            <div class='statistic text-center'>
                <div class='type'>g</div>
                <div class='value'><?=$player->season_stats->goals?></div>
            </div>
            <div class='statistic text-center'>
                <div class='type'>a</div>
                <div class='value'><?=$player->season_stats->assists?></div>
            </div>
        </div>
        <div class='player-stats-row'>
            <div class='statistic text-center'>
                <div class='type'>+/-</div>
                <div class='value'><?=$player->season_stats->plus_minus_ratio?></div>
            </div>
            <div class='statistic text-center'>
                <div class='type'>sog</div>
                <div class='value'><?=$player->season_stats->shots_on_goal?></div>
            </div>
            <div class='statistic text-center'>
                <div class='type'>s%</div>
                <div class='value'><?=$shooting_pct?></div>
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