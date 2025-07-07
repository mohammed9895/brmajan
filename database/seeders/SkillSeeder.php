<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            ['en' => 'Frontend Development', 'ar' => 'تطوير الواجهة الأمامية'],
            ['en' => 'Backend Development', 'ar' => 'تطوير الواجهة الخلفية'],
            ['en' => 'Full Stack Development', 'ar' => 'تطوير متكامل'],
            ['en' => 'UI/UX Design', 'ar' => 'تصميم تجربة المستخدم وواجهة الاستخدام'],
            ['en' => 'Mobile App Development', 'ar' => 'تطوير تطبيقات الجوال'],
            ['en' => 'iOS Development', 'ar' => 'تطوير iOS'],
            ['en' => 'Android Development', 'ar' => 'تطوير Android'],
            ['en' => 'Web Design', 'ar' => 'تصميم المواقع'],
            ['en' => 'Game Development', 'ar' => 'تطوير الألعاب'],
            ['en' => '2D Game Design', 'ar' => 'تصميم ألعاب ثنائية الأبعاد'],
            ['en' => '3D Game Design', 'ar' => 'تصميم ألعاب ثلاثية الأبعاد'],
            ['en' => 'DevOps', 'ar' => 'ديف أوبس'],
            ['en' => 'Machine Learning', 'ar' => 'تعلم الآلة'],
            ['en' => 'Deep Learning', 'ar' => 'التعلم العميق'],
            ['en' => 'Data Science', 'ar' => 'علم البيانات'],
            ['en' => 'Data Analysis', 'ar' => 'تحليل البيانات'],
            ['en' => 'Data Visualization', 'ar' => 'تصوير البيانات'],
            ['en' => 'Cybersecurity', 'ar' => 'الأمن السيبراني'],
            ['en' => 'Blockchain', 'ar' => 'البلوك تشين'],
            ['en' => 'Smart Contracts', 'ar' => 'العقود الذكية'],
            ['en' => 'Cryptography', 'ar' => 'التشفير'],
            ['en' => 'Internet of Things (IoT)', 'ar' => 'إنترنت الأشياء'],
            ['en' => 'Embedded Systems', 'ar' => 'الأنظمة المدمجة'],
            ['en' => 'Database Design', 'ar' => 'تصميم قواعد البيانات'],
            ['en' => 'SQL', 'ar' => 'لغة SQL'],
            ['en' => 'NoSQL', 'ar' => 'قواعد بيانات NoSQL'],
            ['en' => 'Cloud Computing', 'ar' => 'الحوسبة السحابية'],
            ['en' => 'AWS', 'ar' => 'خدمات أمازون السحابية (AWS)'],
            ['en' => 'Google Cloud', 'ar' => 'سحابة Google'],
            ['en' => 'Azure', 'ar' => 'مايكروسوفت Azure'],
            ['en' => 'API Development', 'ar' => 'تطوير واجهات البرمجة (API)'],
            ['en' => 'API Integration', 'ar' => 'دمج واجهات البرمجة'],
            ['en' => 'Scrum/Agile', 'ar' => 'سكرم / أجايل'],
            ['en' => 'Figma Design', 'ar' => 'تصميم باستخدام Figma'],
            ['en' => 'Canva Design', 'ar' => 'تصميم باستخدام Canva'],
            ['en' => 'Product Management', 'ar' => 'إدارة المنتجات'],
            ['en' => 'Project Management', 'ar' => 'إدارة المشاريع'],
            ['en' => 'Business Analysis', 'ar' => 'تحليل الأعمال'],
            ['en' => 'Quality Assurance', 'ar' => 'ضمان الجودة'],
            ['en' => 'Software Testing', 'ar' => 'اختبار البرمجيات'],
            ['en' => 'Unit Testing', 'ar' => 'اختبار الوحدات'],
            ['en' => 'Pitching', 'ar' => 'عرض الأفكار'],
            ['en' => 'Presentation Design', 'ar' => 'تصميم العروض التقديمية'],
            ['en' => 'Public Speaking', 'ar' => 'التحدث أمام الجمهور'],
            ['en' => 'Marketing', 'ar' => 'التسويق'],
            ['en' => 'Digital Marketing', 'ar' => 'التسويق الرقمي'],
            ['en' => 'SEO', 'ar' => 'تحسين محركات البحث (SEO)'],
            ['en' => 'Social Media', 'ar' => 'وسائل التواصل الاجتماعي'],
            ['en' => 'Copywriting', 'ar' => 'كتابة المحتوى'],
            ['en' => 'Technical Writing', 'ar' => 'الكتابة التقنية'],
            ['en' => 'Content Creation', 'ar' => 'إنشاء المحتوى'],
            ['en' => 'Video Editing', 'ar' => 'تحرير الفيديو'],
            ['en' => 'Photography', 'ar' => 'التصوير الفوتوغرافي'],
            ['en' => 'Graphic Design', 'ar' => 'التصميم الجرافيكي'],
            ['en' => '3D Modeling', 'ar' => 'النمذجة ثلاثية الأبعاد'],
            ['en' => 'Animation', 'ar' => 'الرسوم المتحركة'],
            ['en' => 'AI Prompt Engineering', 'ar' => 'هندسة المطالبات للذكاء الاصطناعي'],
            ['en' => 'Soft Skills', 'ar' => 'المهارات الناعمة'],
            ['en' => 'Team Collaboration', 'ar' => 'العمل الجماعي'],
            ['en' => 'Time Management', 'ar' => 'إدارة الوقت'],
            ['en' => 'Problem Solving', 'ar' => 'حل المشكلات'],
            ['en' => 'Critical Thinking', 'ar' => 'التفكير النقدي'],
            ['en' => 'Leadership', 'ar' => 'القيادة']
        ];

        foreach ($skills as $skill) {
            DB::table('skills')->insert([
                'name' => json_encode($skill, JSON_UNESCAPED_UNICODE),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
