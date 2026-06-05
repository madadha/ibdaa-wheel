<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\WheelItem;
use Illuminate\Database\Seeder;

class WheelSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'title_ar' => 'الصمود',
                'title_he' => 'חוסן',
                'color' => '#0E8FA8',
                'items' => [
                    ['ar' => 'الأمل والتفاؤل', 'he' => 'תקווה ואופטימיות'],
                    ['ar' => 'المثابرة', 'he' => 'התמדה'],
                    ['ar' => 'تقبّل التحديات', 'he' => 'קבלת אתגרים'],
                    ['ar' => 'تنظيم المشاعر', 'he' => 'ויסות רגשי'],
                    ['ar' => 'الوعي الذاتي', 'he' => 'מודעות עצמית'],
                ],
            ],
            [
                'title_ar' => 'تعزيز نقاط القوة',
                'title_he' => 'חיזוק החוזקות',
                'color' => '#E59A16',
                'items' => [
                    ['ar' => 'التعرّف على نقاط القوة', 'he' => 'היכרות עם חוזקות'],
                    ['ar' => 'الثقة بالنفس', 'he' => 'ביטחון עצמי'],
                    ['ar' => 'الشعور بالقيمة والقدرة', 'he' => 'תחושת ערך ומסוגלות'],
                    ['ar' => 'المواهب والأهداف', 'he' => 'כישרונות ומטרות'],
                    ['ar' => 'تقدير الذات الإيجابي', 'he' => 'הערכה עצמית חיובית'],
                ],
            ],
            [
                'title_ar' => 'الكفاءة الذاتية',
                'title_he' => 'מסוגלות',
                'color' => '#4D8F43',
                'items' => [
                    ['ar' => 'مهارات التعلم', 'he' => 'מיומנויות למידה'],
                    ['ar' => 'مهارات الحياة', 'he' => 'מיומנויות חיים'],
                    ['ar' => 'التفكير الإبداعي', 'he' => 'חשיבה יצירתית'],
                    ['ar' => 'اتخاذ القرارات', 'he' => 'קבלת החלטות'],
                    ['ar' => 'المشاركة المجتمعية', 'he' => 'מעורבות קהילתית'],
                ],
            ],
            [
                'title_ar' => 'الانتماء للمجتمع',
                'title_he' => 'חיבור לקהילה',
                'color' => '#6B3F91',
                'items' => [
                    ['ar' => 'الانتماء للمجموعة', 'he' => 'שייכות לקבוצה'],
                    ['ar' => 'التواصل باحترام', 'he' => 'תקשורת מכבדת'],
                    ['ar' => 'التعاطف واحترام الآخر', 'he' => 'אמפתיה וכבוד לשוני'],
                    ['ar' => 'العطاء والعمل', 'he' => 'נתינה ועשייה'],
                    ['ar' => 'علاقات ذات معنى', 'he' => 'חיבורים משמעותיים'],
                ],
            ],
        ];

        foreach ($categories as $categoryIndex => $categoryData) {
            $category = Category::updateOrCreate(
                ['title_he' => $categoryData['title_he']],
                [
                    'title_ar' => $categoryData['title_ar'],
                    'color' => $categoryData['color'],
                    'sort_order' => $categoryIndex + 1,
                    'is_active' => true,
                ]
            );

            foreach ($categoryData['items'] as $itemIndex => $itemData) {
                WheelItem::updateOrCreate(
                    [
                        'category_id' => $category->id,
                        'title_he' => $itemData['he'],
                    ],
                    [
                        'title_ar' => $itemData['ar'],
                        'description_ar' => 'شرح مختصر حول ' . $itemData['ar'] . ' وكيف يمكن للطالب تطبيقه في حياته اليومية.',
                        'description_he' => 'הסבר קצר על ' . $itemData['he'] . ' וכיצד התלמיד יכול ליישם זאת בחיי היום־יום.',
                        'question_ar' => 'كيف أستطيع تطبيق هذا المجال في موقف حقيقي؟',
                        'question_he' => 'כיצד אוכל ליישם את התחום הזה במצב אמיתי?',
                        'sort_order' => $itemIndex + 1,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}