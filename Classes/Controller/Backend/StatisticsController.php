<?php
namespace PAGEmachine\Ats\Controller\Backend;

/*
 * This file is part of the PAGEmachine ATS project.
 */


/**
 * StatisticsController
 */
class StatisticsController extends AbstractBackendController
{
    /**
     *
     * @var \PAGEmachine\Ats\Service\StatisticsService
     * @inject
     */
    protected $statisticsService;

    /**
     *
     * @var \PAGEmachine\Ats\Service\ExportService
     * @inject
     */
    protected $exportService;

    /**
     * Action URLs for the action menu
     *
     * @var array
     */
    protected $menuUrls = [
        'statistics' => ["action" => "statistics", "label" => "be.label.Statistics"],
        'export' => ["action" => "export", "label" => "be.label.Export"],
    ];

    /**
     * Testing helper class
     *
     * @return MenuRegistry
     * @codeCoverageIgnore
     */
    public function getMenuRegistry()
    {
        return $this->view->getModuleTemplate()->getDocHeaderComponent()->getMenuRegistry();
    }

    /**
     * Statistics action - displays statistics
     *
     * @param array $date
     * @return void
     */
    public function statisticsAction(array $dates = null)
    {
        if ($dates != null) {
            $this->view->assignMultiple([
                'start' => $dates['start'],
                'finish' => $dates['finish'],
            ]);
        }
        $totalApplications = $this->statisticsService->getTotalApplications($dates);
        $totalApplicationsProvenance = $this->statisticsService->getTotalApplicationsProvenance($dates);
        $ageDistribution = $this->statisticsService->getAgeDistributionUnder($dates);
        $tenderingProcedures = $this->statisticsService->getTenderingProcedures($dates);
        $interviews = $this->statisticsService->getInterviews($dates);
        $provenances = $this->statisticsService->getProvenances($dates);
        $applications = $this->statisticsService->getApplications($dates);
        $positions = $this->statisticsService->getOccupiedPositions($dates);

        $this->view->assignMultiple([
            'totalApplications' => $totalApplications,
            'totalApplicationsProvenance' => $totalApplicationsProvenance,
            'tenderingProcedures' => $tenderingProcedures,
            'ageDistribution' => $ageDistribution,
            'provenances' => $provenances,
            'applications' => $applications,
            'interviews' => $interviews,
            'positions' => $positions,
            ]);
    }

    /**
     * export action - displays Export
     *
     * @return void
     */
    public function exportAction()
    {
        $this->view->assignMultiple([
            'exportOptions' => $this->exportService->getExportOptions(),
            'jobOptions' => $this->exportService->getJobOptions(),
            ]);
    }

    /**
     * getCsv action - Download export CSV
     *
     * @param   array $selectedOptions
     * @param   array $filter
     * @param   string $exportType 'export' = normal export. 'simple' = simple export. 'custom' = Custom export
     * @return void
     */
    public function getCsvAction(array $selectedOptions = null, array $filter = null, $exportType)
    {
        switch ($exportType) {
            case 'export':
                $selectedOptions = $this->exportService->getDefaultOptions();
                break;

            case 'simple':
                $selectedOptions = $this->exportService->getSimpleOptions();
                break;
        }
        $this->exportService->getCSV($selectedOptions, $filter);
        $this->redirect("export");
    }
}
