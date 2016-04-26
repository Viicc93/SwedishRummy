<?php
$deck_ob     = file_get_contents(Session::getSession('path_to_serialize_tx'));
$unSrlz_deck = unserialize($deck_ob);
