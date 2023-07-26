<?php
/**
 * Server info
 *
 * @package   MyAAC
 * @author    Gesior <jerzyskalski@wp.pl>
 * @author    Slawkens <slawkens@gmail.com>
 * @author    whiteblXK
 * @copyright 2019 MyAAC
 * @link      https://my-aac.org
 */
defined('MYAAC') or die('Direct access not allowed!');
$title = 'Server info';

if (isset($config['lua']['experience_stages']))
    $config['lua']['experienceStages'] = $config['lua']['experience_stages'];

if (isset($config['lua']['min_pvp_level']))
    $config['lua']['protectionLevel'] = $config['lua']['min_pvp_level'];

$rent = trim(strtolower($config['lua']['houseRentPeriod']));
if ($rent != 'yearly' && $rent != 'monthly' && $rent != 'weekly' && $rent != 'daily')
    $rent = 'never';

if (isset($config['lua']['houseCleanOld']))
    $cleanOld = (int)(eval('return ' . $config['lua']['houseCleanOld'] . ';') / (24 * 60 * 60));

if (isset($config['lua']['rate_exp']))
    $config['lua']['rateExp'] = $config['lua']['rate_exp'];
if (isset($config['lua']['rateExperience']))
    $config['lua']['rateExp'] = $config['lua']['rateExperience'];
if (isset($config['lua']['rate_mag']))
    $config['lua']['rateMagic'] = $config['lua']['rate_mag'];
if (isset($config['lua']['rate_skill']))
    $config['lua']['rateSkill'] = $config['lua']['rate_skill'];
if (isset($config['lua']['rate_loot']))
    $config['lua']['rateLoot'] = $config['lua']['rate_loot'];
if (isset($config['lua']['rate_spawn']))
    $config['lua']['rateSpawn'] = $config['lua']['rate_spawn'];

$house_level = NULL;
if (isset($config['lua']['levelToBuyHouse']))
    $house_level = $config['lua']['levelToBuyHouse'];
else if (isset($config['lua']['house_level']))
    $house_level = $config['lua']['house_level'];

if (isset($config['lua']['in_fight_duration']))
    $config['lua']['pzLocked'] = $config['lua']['in_fight_duration'];

$pzLocked = eval('return ' . $config['lua']['pzLocked'] . ';');
$whiteSkullTime = $config['lua']['whiteSkullTime'] ?? NULL;
if (!isset($whiteSkullTime) && isset($config['lua']['unjust_skull_duration']))
    $whiteSkullTime = $config['lua']['unjust_skull_duration'];

if (isset($whiteSkullTime))
    $whiteSkullTime = eval('return ' . $whiteSkullTime . ';');

$redSkullLength = $config['lua']['redSkullLength'] ?? NULL;
if (!isset($redSkullLength) && isset($config['lua']['red_skull_duration']))
    $redSkullLength = $config['lua']['red_skull_duration'];

if (isset($redSkullLength))
    $redSkullLength = eval('return ' . $redSkullLength . ';');

$blackSkull = false;
$blackSkullLength = NULL;
if (isset($config['lua']['useBlackSkull']) && getBoolean($config['lua']['useBlackSkull'])) {
    $blackSkullLength = $config['lua']['blackSkullLength'];
    $blackSkull = true;
} else if (isset($config['lua']['black_skull_duration'])) {
    $blackSkullLength = eval('return ' . $config['lua']['blackSkullLength'] . ';');
    $blackSkull = true;
}

$server_save = $config['server_save'];
$explodeServerSave = explode(':', $server_save);
$hours_ServerSave = $explodeServerSave[0];
$minutes_ServerSave = $explodeServerSave[1];
$seconds_ServerSave = $explodeServerSave[2];

$clientVersion = NULL;
if (isset($status['online']))
    $clientVersion = $status['clientVersion'] ?? null;

$twig->display('serverinfo.html.twig', array(
    'server_save' => $explodeServerSave,
    'experienceStages' => isset($config['lua']['experienceStages']) && getBoolean($config['lua']['experienceStages']) ? $config['lua']['experienceStages'] : null,
    'serverIp' => str_replace('/', '', str_replace('http://', '', $config['lua']['url'])),
    'clientVersion' => $clientVersion,
    'globalSaveHour' => isset($config['lua']['globalSaveEnabled']) && getBoolean($config['lua']['globalSaveEnabled']) ? $config['lua']['globalSaveHour'] : null,
    'protectionLevel' => $config['lua']['protectionLevel'],
    'houseRent' => $rent == 'never' ? 'disabled' : $rent,
    'houseOld' => $cleanOld ?? null,
    'rateExp' => $config['lua']['rateExp'],
    'rateExpFromPlayers' => $config['lua']['rateExperienceFromPlayers'] ?? null,
    'rateMagic' => $config['lua']['rateMagic'],
    'rateSkill' => $config['lua']['rateSkill'],
    'rateLoot' => $config['lua']['rateLoot'],
    'rateSpawn' => $config['lua']['rateSpawn'],
    'houseLevel' => $house_level,
    'pzLocked' => $pzLocked,
    'whiteSkullTime' => $whiteSkullTime,
    'redSkullLength' => $redSkullLength,
    'blackSkull' => $blackSkull,
    'blackSkullLength' => $blackSkullLength,
    'dailyFragsToRedSkull' => $config['lua']['dailyFragsToRedSkull'] ?? ($config['lua']['kills_per_day_red_skull'] ?? null),
    'weeklyFragsToRedSkull' => $config['lua']['weeklyFragsToRedSkull'] ?? ($config['lua']['kills_per_week_red_skull'] ?? null),
    'monthlyFragsToRedSkull' => $config['lua']['monthlyFragsToRedSkull'] ?? ($config['lua']['kills_per_month_red_skull'] ?? null),
    'dailyFragsToBlackSkull' => $config['lua']['dailyFragsToBlackSkull'] ?? ($config['lua']['kills_per_day_black_skull'] ?? null),
    'weeklyFragsToBlackSkull' => $config['lua']['weeklyFragsToBlackSkull'] ?? ($config['lua']['kills_per_week_black_skull'] ?? null),
    'monthlyFragsToBlackSkull' => $config['lua']['monthlyFragsToBlackSkull'] ?? ($config['lua']['kills_per_month_black_skull'] ?? null),
    'banishmentLength' => isset($config['lua']['banishment_length']) ? eval('return (' . $config['lua']['banishment_length'] . ') / (24 * 60 * 60);') : null,
    'finalBanishmentLength' => isset($config['lua']['final_banishment_length']) ? eval('return (' . $config['lua']['final_banishment_length'] . ') / (24 * 60 * 60);') : null,
    'ipBanishmentLength' => isset($config['lua']['ip_banishment_length']) ? eval('return (' . $config['lua']['ip_banishment_length'] . ') / (24 * 60 * 60);') : null,
));
