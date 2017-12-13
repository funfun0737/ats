
plugin.tx_ats {
  view {
    # cat=plugin.tx_ats/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:ats/Resources/Private/Templates/
    # cat=plugin.tx_ats/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:ats/Resources/Private/Partials/
    # cat=plugin.tx_ats/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:ats/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_ats//a; type=string; label=Default storage PID
    storagePid =
  }
  settings {
    # cat=plugin.tx_ats//a; type=boolean; label=Include jQuery
    includeJQuery =
    # cat=plugin.tx_ats//a; type=string; label=Login page to redirect to when no login is active
    loginPage =
    # cat=plugin.tx_ats//a; type=string; label=FE User group that has access
    feUserGroup =
    # cat=plugin.tx_ats//a; type=string; label=Allowed languages in language skill dropdown
    allowedStaticLanguages =
    # cat=plugin.tx_ats/pages; type=string; label=Privacy Policy page
    policyPage =
  }
}
