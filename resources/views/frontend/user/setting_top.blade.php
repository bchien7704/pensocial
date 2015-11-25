<div class="settings_top_header">
    <div class="settings_top_header_title">
        Settings
    </div>

    <div class="settings_top_header_menu_1">
        @if(!isset($_GET['tab']) )
            <a class="search_top_header_menu_link" href="settings?tab=account">Account</a>
        @elseif($_GET['tab'] == 'account')
            <a class="search_top_header_menu_link" href="settings?tab=account">Account</a>
        @else
            <a class="search_top_header_menu_unselected_link" href="settings?tab=account">Account</a>

        @endif
    </div>
    <div style="width: 10px;" class="search_top_filler">&nbsp;</div>
    <div class="settings_top_header_menu_1" style="width: 135px;">
        @if(isset($_GET['tab'])&& $_GET['tab'] == 'email' )
            <a class="search_top_header_menu_link" href="settings?tab=email">Email preferences</a>
        @else
            <a class="search_top_header_menu_unselected_link" href="settings?tab=email">Email preferences</a>

        @endif
    </div>
    <div style="width: 258px;" class="search_top_filler">&nbsp;</div>

    <div class="clear"><!-- --></div>
</div>