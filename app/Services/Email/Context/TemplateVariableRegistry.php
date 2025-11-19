<?php

namespace App\Services\Email\Context;

use App\Models\User;
use App\Models\FrontOrderDetails;
use App\Models\Course;
use App\Models\Cohort;
use App\Models\ProductInvoice;

class TemplateVariableRegistry
{
    protected $introspector;

    public function __construct(ModelIntrospector $introspector)
    {
        $this->introspector = $introspector;
    }

    public function schema(): array
    {
        $userCols = $this->introspector->getColumnsForModel(new User());

        $enrollmentColsRaw = $this->introspector->getColumnsForModel(new FrontOrderDetails());
        $enrollmentCols    = $this->filterEnrollmentColumns($enrollmentColsRaw);

        $courseCols = $this->introspector->getColumnsForModel(new Course());
        $cohortCols = $this->introspector->getColumnsForModel(new Cohort());

        foreach ($cohortCols as $col => $pretty) {
            $courseCols['cohort_' . $col] = 'Cohort ' . $pretty;
        }

        $invoiceCols = $this->introspector->getColumnsForModel(new ProductInvoice());

        return [
            'user'       => $userCols,
            'course'     => $courseCols,
            'enrollment' => $enrollmentCols,
            'invoice'    => $invoiceCols,
        ];
    }

    public function placeholdersForUI(): array
    {
        $schema = $this->schema();
        $out = [];

        foreach ($schema as $groupKey => $fields) {
            $children = [];
            foreach ($fields as $fieldKey => $label) {
                $placeholder = '{{' . $groupKey . '.' . $fieldKey . '}}';
                $children[] = [
                    'id'   => $placeholder,
                    'text' => $placeholder . ' — ' . $label,
                ];
            }

            $out[] = [
                'text'     => $this->humanGroupName($groupKey),
                'children' => $children,
            ];
        }

        $out[] = [
            'text'     => 'Special',
            'children' => [
                [
                    'id'   => '{{payment_details}}',
                    'text' => '{{payment_details}} — Payment Details Table',
                ],
            ],
        ];

        return $out;
    }

    protected function humanGroupName(string $groupKey): string
    {
        switch ($groupKey) {
            case 'user':
                return 'User';
            case 'course':
                return 'Course / Cohort';
            case 'enrollment':
                return 'Enrollment';
            case 'invoice':
                return 'Invoice';
            default:
                return ucfirst($groupKey);
        }
    }

    protected function filterEnrollmentColumns(array $cols): array
    {
        $blocked = [
            'cost_price',
            'course_price',
            'quantity',
            'total_price',
            'vat',
            'deposit_paid',
            'deposit_amount',
            'remaining_balance',
            'discount',
        ];

        $filtered = [];
        foreach ($cols as $key => $label) {

            if (in_array($key, $blocked, true)) {
                continue;
            }
            $filtered[$key] = $label;
        }

        return $filtered;
    }
}
