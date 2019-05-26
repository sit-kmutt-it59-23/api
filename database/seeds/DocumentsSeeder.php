<?php

use Illuminate\Database\Seeder;

use App\Models\DocumentProjectCategory;
use App\Models\DocumentProject;
use App\Models\DocumentStep;
use App\Models\DocumentType;

class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $docProjCat = [
            ['name' => 'academic'],
            ['name' => 'art'],
            ['name' => 'community_service'],
            ['name' => 'entrepreneurship'] ,
            ['name' => 'personality_recreation'],
            ['name' => 'sport'],
            ['name' => 'university_loyality']
        ];
        DocumentProjectCategory::insert($docProjCat);

        $docType = [
            ['name' => 'activity_proposal'],
            ['name' => 'summary_report']
        ];
        DocumentType::insert($docType);

        $docStep = [
            ['name' => 'advisor'],
            ['name' => 'student_union'],
            ['name' => 'student_council'],
            ['name' => 'student_affair'],
            ['name' => 'vice_president_activity']
        ];
        DocumentStep::insert($docStep);

        $docAdvisorStep = DocumentStep::where('name', 'advisor')->first();
        $docStdUnionStep = DocumentStep::where('name', 'student_union')->first();
        $docStdCouncilStep = DocumentStep::where('name', 'student_council')->first();
        $docStdAffairStep = DocumentStep::where('name', 'student_affair')->first();

        $docActivityProposal = DocumentType::where('name', 'activity_proposal')->first();
        $docActivityProposal->document_versions()->create([
            'name' => '2019-05-18'
        ]);
        
        $docActivityProposal->document_steps()->save($docAdvisorStep, ['order' => 1]);
        $docActivityProposal->document_steps()->save($docStdUnionStep, ['order' => 2]);
        $docActivityProposal->document_steps()->save($docStdCouncilStep, ['order' => 3]);
        $docActivityProposal->document_steps()->save($docStdAffairStep, ['order' => 4]);

        $docSummaryReport = DocumentType::where('name', 'summary_report')->first();
        $docSummaryReport->document_versions()->create([
            'name' => '2019-05-18'
        ]);

        $docSummaryReport->document_steps()->save($docAdvisorStep, ['order' => 1]);
        $docSummaryReport->document_steps()->save($docStdAffairStep, ['order' => 2]);

        if (env('APP_ENV') == 'local') {
            factory(DocumentProject::class, 40)->create();
        }
    }
}
