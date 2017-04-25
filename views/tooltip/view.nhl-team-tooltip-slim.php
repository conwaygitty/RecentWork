<?php
/*
 * NHL Team Tooltip View Template
 */
?>

<div class='tooltip-main-container'>

    <div class='team-info-container <?='nhl-'.$team_data['short_name'] ?>'>
        <div class="top-info">
        <div class='team-name-city'><?=$team_data['team_city']?></div>
        <div class='team-name'><?=$team_data['team_name']?></div>
        
            <div class='team-rank'><span class="bolder"><?=$team_data['conference_rank']?></span> <?=$team_data['conference']?></div>
            <div class='team-rank'><span class="bolder"><?=$team_data['division_rank']?></span> <?=$team_data['division']?></div>
            <div class='team-rank'><span class="bolder"><?=$team_data['points']?></span> Points</div>
        </div>

        <div class='team-logo'>
            <img src="<?=$team_data['str_team_image_url']?>">
        </div>

    </div>
    
    <div class='team-stats'>
        <div class='team-stats-row'>
            <div class='statistic text-center'>
                <div class='type'>record</div>
                <div class='value'><?=$team_data['record']?></div>
                <div class='place'><?=$team_data['conference_rank_sup']?></div> 
            </div>
            <div class='statistic text-center'>
                <div class='type'>gpg</div>
                <div class='value'><?=$team_data['nhl']['ranking']['sub-position-1']?></div>
                <div class='place'><?=$team_data['nhl']['ranking']['position-1']?></div>
            </div>
            <div class='statistic text-center'>
                <div class='type'>pp%</div>
                <div class='value'><?=$team_data['nhl']['ranking']['sub-position-3']?></div>
                <div class='place'><?=$team_data['nhl']['ranking']['position-3']?></div>
            </div>
        </div>
        <div class='team-stats-row'>
            <div class='statistic text-center'>
                <div class='type'>last 5</div>
                <div class='value'><?=$team_data['nhl']['ranking']['last_5_games']?></div>
            </div>
            <div class='statistic text-center'>
                <div class='type'>gaa</div>
                <div class='value'><?=$team_data['nhl']['ranking']['sub-position-2']?></div>
                <div class='place'><?=$team_data['nhl']['ranking']['position-2']?></div>
            </div>
            <div class='statistic text-center'>
                <div class='type'>pk%</div>
                <div class='value'><?=$team_data['nhl']['ranking']['sub-position-4']?></div>
                <div class='place'><?=$team_data['nhl']['ranking']['position-4']?></div>
            </div>
        </div>
    </div>

    <div class='team-link-container <?='nhl-tooltip-border-top-'.$team_data['short_name'] ?>'>
        <div class='clearfix'></div>
        <div class='team-page'>
            <a class='tooltip-team-link' target='_blank' data-team='' href="<?=$team_data['team_url']?>">Visit Team Page</a>
        </div>
    </div>

</div>