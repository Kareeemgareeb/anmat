<?php

namespace Database\Seeders;

use App\Models\Correspondence;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class CompanyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Company Settings
        $settings = [
            'company_name' => [
                'ar' => 'أنماط للأعمال والاستشارات الهندسية',
                'en' => 'ANMAT Engineering Works & Consultancy',
            ],
            'company_tagline' => [
                'ar' => 'رؤية هندسية دقيقة تبني المستقبل وتجسد الإتقان',
                'en' => 'Precision Engineering Vision Building the Future',
            ],
            'hero_badge' => [
                'ar' => 'بيت خبرة هندسي واستشاري معتمد',
                'en' => 'Certified Engineering & Consultancy House',
            ],
            'hero_title' => [
                'ar' => 'حلول هندسية ومساحية متكاملة بأعلى معايير الدقة والابتكار',
                'en' => 'Integrated Engineering & Surveying Solutions with Supreme Precision',
            ],
            'hero_subtitle' => [
                'ar' => 'نقدم استشارات هندسية متخصصة تشمل أعمال المسح الطبوغرافي، التصميم الإنشائي والمعماري، وإدارة المشاريع والإشراف الميداني لضمان جودة استثنائية.',
                'en' => 'We deliver specialized engineering consultancy spanning topographic surveys, architectural & structural design, and field project supervision ensuring benchmark quality.',
            ],
            'about_intro' => [
                'ar' => 'شركة "أنماط" للأعمال والاستشارات الهندسية هي بيت خبرة رائد يجمع بين التخصص الأكاديمي والخبرة الميدانية الواسعة. تأسست الشركة لتقديم حلول واستشارات هندسية متطورة تلبي متطلبات المشاريع الكبرى وفق المعايير الدولية والمحلية.',
                'en' => 'ANMAT Engineering Works & Consultancy is a premier firm bridging academic mastery and extensive field execution. Founded to deliver cutting-edge engineering solutions meeting international and national standards for high-stakes projects.',
            ],
            'about_vision' => [
                'ar' => 'أن نكون الخيار الأول والشريك الموثوق في تقديم الاستشارات الهندسية والأعمال المساحية في ليبيا والمنطقة، من خلال الالتزام بأعلى معايير الدقة الهندسية والتحول الرقمي في إدارة المشاريع.',
                'en' => 'To be the first-choice and most trusted partner in engineering consultancy and geospatial surveying across Libya and the region, driven by uncompromising accuracy and digital project governance.',
            ],
            'about_mission' => [
                'ar' => 'تمكين عملائنا من تحقيق تطلعاتهم الإنشائية عبر تقديم دراسات هندسية رصينة، وتصاميم مبتكرة، وإشراف ميداني دقيق يضمن سلامة المنشآت وكفاءة التكاليف وسرعة الإنجاز.',
                'en' => 'Empowering clients to realize construction ambitions through rigorous technical studies, innovative blueprints, and rigorous site supervision that guarantees structural integrity, cost efficiency, and timely delivery.',
            ],
            'stat_years' => '15+',
            'stat_projects' => '120+',
            'stat_surveys' => '450+',
            'stat_engineers' => '25+',
            'phone' => '+218 91 000 0000',
            'phone_secondary' => '+218 21 000 0000',
            'email' => 'info@anmat.ly',
            'email_support' => 'support@anmat.ly',
            'whatsapp' => '+218910000000',
            'address' => [
                'ar' => 'طرابلس - حي الأندلس / برج الأعمال، ليبيا',
                'en' => 'Tripoli - Hay Al-Andalus / Business Center, Libya',
            ],
            'working_hours' => [
                'ar' => 'الأحد - الخميس: 8:30 صباحاً - 4:30 مساءً',
                'en' => 'Sunday - Thursday: 8:30 AM - 4:30 PM',
            ],
            'facebook' => 'https://facebook.com/anmat.engineering',
            'linkedin' => 'https://linkedin.com/company/anmat-ly',
            'twitter' => 'https://twitter.com/anmat_ly',
        ];

        foreach ($settings as $key => $val) {
            Setting::set($key, $val);
        }

        // 2. Seed Services
        Service::truncate();
        $services = [
            [
                'title' => [
                    'ar' => 'الأعمال والمساحة الطبوغرافية',
                    'en' => 'Geodetic & Topographic Surveying',
                ],
                'category' => [
                    'ar' => 'المساحة والجيوديسيا',
                    'en' => 'Surveying & Geodesy',
                ],
                'short_description' => [
                    'ar' => 'رفع مساحي عالي الدقة باستخدام أحدث أجهزة GPS و Total Station والمحطات الفضائية.',
                    'en' => 'High-precision land surveying utilizing state-of-the-art GNSS/GPS, total stations, and 3D geospatial scanning.',
                ],
                'description' => [
                    'ar' => 'نقدم منظومة مساحية متكاملة تشمل الرفع المساحي الطبوغرافي، وتحديد الحدود العقارية، والمسح الجيوديسي للشبكات، وحساب كميات الحفر والردم بدقة رقمية متناهية، وإسقاط المخططات على الواقع بدقة ملليمترية.',
                    'en' => 'Comprehensive geodetic services covering topographic site surveys, boundary demarcation, geodetic control networks, cut-and-fill volumetric computations, and pinpoint millimeter-accuracy as-built setting out.',
                ],
                'features' => [
                    'ar' => "رفع مساحي طبوغرافي ورقمي (GIS & CAD)\nتحديد الحدود وتثبيت النقاط المرجعية\nحساب كميات الحفر والردم بدقة عالية\nمسح الطرق وشبكات البنية التحتية",
                    'en' => "Digital topographic & contour mapping (GIS & CAD)\nCadastral boundaries & geodetic control benchmarks\nHigh-precision earthworks volume calculations\nRoad alignments & infrastructure utility surveys",
                ],
                'icon' => 'compass',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => [
                    'ar' => 'التصميم الإنشائي ودراسات الأحمال',
                    'en' => 'Structural Engineering & Load Analysis',
                ],
                'category' => [
                    'ar' => 'الهندسة الإنشائية',
                    'en' => 'Structural Design',
                ],
                'short_description' => [
                    'ar' => 'تصاميم إنشائية آمنة واقتصادية مطابقة للكودات الدولية، مع نمذجة متطورة لمقاومة الزلازل والرياح.',
                    'en' => 'Safe, cost-optimized structural blueprints meeting international codes, modeled for seismic and wind load resilience.',
                ],
                'description' => [
                    'ar' => 'إعداد المخططات الإنشائية للخرسانة المسلحة والمنشآت الفولاذية، وحسابات الأساسات العميقة والسطحية، وتحليل الإجهادات عبر أحدث البرمجيات الهندسية لضمان سلامة المبنى واستدامته مع مراعاة الجدوى الاقتصادية.',
                    'en' => 'Preparation of reinforced concrete and structural steel execution drawings, foundation engineering, advanced finite element modeling (FEM), and seismic load assessments ensuring maximum safety and material efficiency.',
                ],
                'features' => [
                    'ar' => "تصميم الخرسانة المسلحة والهياكل المعدنية\nتحليل الأحمال الديناميكية والزلزالية\nدراسة وتصميم الأساسات الخاصة والعميقة\nتدقيق المخططات الإنشائية وإعادة التقييم",
                    'en' => "Reinforced concrete & steel frame structural design\nDynamic wind & seismic resistance analysis\nSpecial foundation & deep piling design\nStructural peer-review and code compliance auditing",
                ],
                'icon' => 'building',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => [
                    'ar' => 'التصميم المعماري والتخطيط الحضري',
                    'en' => 'Architectural Design & Urban Masterplanning',
                ],
                'category' => [
                    'ar' => 'العمارة والتخطيط',
                    'en' => 'Architecture',
                ],
                'short_description' => [
                    'ar' => 'بلورة رؤى معمارية عصرية تمزج بين الأصالة والجمال الوظيفي، وتستجيب للبيئة المحيطة.',
                    'en' => 'Crafting contemporary architectural masterpieces that harmonize spatial efficiency, aesthetics, and environmental responsiveness.',
                ],
                'description' => [
                    'ar' => 'ابتكار مفاهيم معمارية فريدة للمباني السكنية، التجارية، والإدارية، وتخطيط المجمعات العمرانية والضواحي السكنية، مع تقديم مجسمات ورندرات ثلاثية الأبعاد واقعية توضح أدق تفاصيل الواجهات والتوزيع الداخلي.',
                    'en' => 'Conceptual architectural design for commercial towers, residential communities, and institutional complexes, coupled with hyper-realistic 3D visualization, BIM modeling, and sustainable bioclimatic layouts.',
                ],
                'features' => [
                    'ar' => "تصميم معماري متكامل (مساقط، واجهات، قطاعات)\nنمذجة ثلاثية الأبعاد ورندرات سينمائية فائقة الدقة\nتخطيط حضري للمخططات السكنية والتجارية\nدراسات الإضاءة الطبيعية والتهوية المستدامة",
                    'en' => "Comprehensive architectural schematic & execution packages\nPhoto-realistic 3D rendering and VR walk-throughs\nUrban master-planning and zoning layouts\nNatural lighting and bioclimatic energy studies",
                ],
                'icon' => 'home',
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'title' => [
                    'ar' => 'إدارة المشاريع والإشراف الهندسي الميداني',
                    'en' => 'Project Management & Construction Supervision',
                ],
                'category' => [
                    'ar' => 'الإشراف وإدارة المشاريع',
                    'en' => 'Management & Supervision',
                ],
                'short_description' => [
                    'ar' => 'متابعة دورية وإشراف صارم على مواقع التنفيذ لضمان مطابقة المواصفات والالتزام بالجدول الزمني.',
                    'en' => 'Rigorous site supervision and governance guaranteeing flawless contractor execution, schedule adherence, and budget control.',
                ],
                'description' => [
                    'ar' => 'نوفر طواقم هندسية مقيمة وزائرة للإشراف على كافة مراحل الإنشاء، واستلام الأعمال الخرسانية والمعدنية والتشطيبات، واعتماد المواد، وتدقيق الجداول الزمنية لتفادي التأخير وضبط الميزانيات.',
                    'en' => 'Resident and visiting consultant teams supervising all construction milestones, structural inspections, material testing & approvals, contractor milestone auditing, and quality assurance.',
                ],
                'features' => [
                    'ar' => "إشراف هندسي يومي وتفتيش دوري للموقع\nاعتماد العينات ومطابقة المواصفات الفنية\nإدارة الجداول الزمنية والتحكم في المخاطر\nإعداد التقارير الفنية الدورية لمالك المشروع",
                    'en' => "Full-time resident site supervision & inspection\nMaterial sample review and technical approval\nCritical path schedule & risk management\nComprehensive progress reports and milestone certificates",
                ],
                'icon' => 'clipboard-check',
                'is_featured' => true,
                'order' => 4,
            ],
            [
                'title' => [
                    'ar' => 'إعداد مقايسات الكميات وحساب المستخلصات (BOQ)',
                    'en' => 'Quantity Surveying & Bills of Quantities (BOQ)',
                ],
                'category' => [
                    'ar' => 'هندسة التكاليف والكميات',
                    'en' => 'Quantity Surveying',
                ],
                'short_description' => [
                    'ar' => 'حصر هندسي دقيق لجميع بنود الأعمال وإعداد جداول الكميات وكراسات الشروط والمواصفات التعاقدية.',
                    'en' => 'Exhaustive quantity take-offs, tender document preparation, and progress payment certification with absolute cost control.',
                ],
                'description' => [
                    'ar' => 'حصر كميات الحفر، الخرسانات، حديد التسليح، والتشطيبات بدقة، وإعداد دفاتر الحصر والمستخلصات المرحلية للمقاولين ومطابقتها مع الواقع الميداني بما يحمي حقوق المالك والمستثمر.',
                    'en' => 'Detailed measurement of civil, structural, architectural, and MEP components, drafting comprehensive Tender BOQs, evaluating contractor progress billing, and managing contract variation orders.',
                ],
                'features' => [
                    'ar' => "إعداد دفاتر الحصر التفصيلية لجميع البنود\nصياغة كراسات الشروط والمواصفات الفنية\nمراجعة وتدقيق المستخلصات الدورية للمقاولين\nدراسة الفروقات وأوامر التغيير التعاقدية",
                    'en' => "Itemized measurement sheets and quantity calculations\nTender specifications and contract documentation\nContractor interim invoice auditing and verification\nVariation order evaluation and financial reconciliation",
                ],
                'icon' => 'calculator',
                'is_featured' => true,
                'order' => 5,
            ],
            [
                'title' => [
                    'ar' => 'دراسات الجدوى الفنية وتقييم المنشآت',
                    'en' => 'Technical Feasibility & Structural Health Auditing',
                ],
                'category' => [
                    'ar' => 'الاستشارات والدراسات',
                    'en' => 'Consultancy',
                ],
                'short_description' => [
                    'ar' => 'تقييم السلامة الإنشائية للمباني القائمة، وتقديم دراسات جدوى فنية متكاملة للمشاريع الاستثمارية.',
                    'en' => 'Comprehensive structural integrity assessments for existing assets alongside robust technical investment appraisals.',
                ],
                'description' => [
                    'ar' => 'فحص المنشآت القائمة لتحديد كفاءتها وسلامتها الإنشائية، واقتراح خطط التدعيم والترميم، وتقديم دراسات الجدوى الهندسية والتكلفة التقديرية للمشاريع قبل البدء في الاستثمار.',
                    'en' => 'In-situ structural diagnostics, non-destructive testing evaluation, structural retrofit & rehabilitation engineering, and early-stage capital expenditure (CAPEX) feasibility studies.',
                ],
                'features' => [
                    'ar' => "فحص وتقييم السلامة الإنشائية للمباني القائمة\nتصميم حلول التدعيم والترميم الإنشائي\nدراسات الجدوى الهندسية والتكلفة التقديرية\nتقارير هندسية معتمدة للجهات الرسمية والمصارف",
                    'en' => "Structural condition surveys & integrity testing\nStructural retrofitting & strengthening schemes\nCapital investment and engineering feasibility reports\nOfficial certified technical reports for banks & authorities",
                ],
                'icon' => 'shield-check',
                'is_featured' => true,
                'order' => 6,
            ],
        ];

        foreach ($services as $srv) {
            Service::create($srv);
        }

        // 3. Seed Projects
        Project::truncate();
        $projects = [
            [
                'title' => [
                    'ar' => 'برج الأعمال الإداري والاستثماري',
                    'en' => 'Commercial & Executive Business Tower',
                ],
                'category' => [
                    'ar' => 'مباني إدارية وتجارية',
                    'en' => 'Commercial & Offices',
                ],
                'client' => [
                    'ar' => 'شركة الاستثمارات العقارية الوطنية',
                    'en' => 'National Real Estate Investment Co.',
                ],
                'location' => [
                    'ar' => 'طرابلس - طريق الشط',
                    'en' => 'Tripoli - Coast Road',
                ],
                'area' => '18,500 م²',
                'status' => 'completed',
                'completion_date' => '2025-11-20',
                'description' => [
                    'ar' => 'إعداد المخططات الإنشائية والمعمارية المتكاملة لبرج إداري يتكون من 16 طابقاً مع مواقف سيارات تحت الأرض، بالإضافة إلى أعمال الرفع المساحي الطبوغرافي والإشراف الكامل على مراحل التنفيذ.',
                    'en' => 'Full architectural and structural engineering consultancy for a 16-storey modern administrative tower including multi-level basement parking, geodetic survey, and resident site supervision.',
                ],
                'image_path' => null,
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => [
                    'ar' => 'مجمع الواحة السكني المغلق',
                    'en' => 'Al-Waha Gated Residential Community',
                ],
                'category' => [
                    'ar' => 'مجمعات سكنية',
                    'en' => 'Residential Compounds',
                ],
                'client' => [
                    'ar' => 'مجموعة التطوير العمراني الحديث',
                    'en' => 'Modern Urban Development Group',
                ],
                'location' => [
                    'ar' => 'مصراتة - حي البساتين',
                    'en' => 'Misrata - Al-Basateen',
                ],
                'area' => '42,000 م²',
                'status' => 'completed',
                'completion_date' => '2025-06-15',
                'description' => [
                    'ar' => 'تخطيط وتصميم مجمع سكني متكامل يضم 48 فيلا سكنية فاخرة ومرافق خدمية، مع تصميم شبكات المياه والصرف والإنارة، ورفع مساحي طبوغرافي لربط المشروع بالطرق الرئيسية.',
                    'en' => 'Masterplanning, architectural blueprints, and infrastructure networks for an upscale gated compound of 48 villas with recreational amenities, topographic road alignment, and stormwater management.',
                ],
                'image_path' => null,
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => [
                    'ar' => 'المسح الطبوغرافي والتخطيط للمنطقة الصناعية',
                    'en' => 'Industrial Zone Geodetic Survey & Masterplan',
                ],
                'category' => [
                    'ar' => 'مساحة وتخطيط بنية تحتية',
                    'en' => 'Surveying & Infrastructure',
                ],
                'client' => [
                    'ar' => 'هيئة تشجيع الاستثمار والمدن الصناعية',
                    'en' => 'Industrial Cities & Investment Authority',
                ],
                'location' => [
                    'ar' => 'الخمس - المنطقة الصناعية',
                    'en' => 'Al-Khums - Industrial District',
                ],
                'area' => '120 هكتار',
                'status' => 'completed',
                'completion_date' => '2024-12-10',
                'description' => [
                    'ar' => 'تنفيذ شبكة مثلثات مساحية ورفع طبوغرافي عالي الدقة لـ 120 هكتاراً باستخدام طائرات الدرون ومحطات الرصد المتطورة، وحساب كميات التسوية الترابية وتثبيت النقاط المساحية المرجعية.',
                    'en' => 'Establishment of geodetic GPS control networks, high-resolution aerial photogrammetry for 120 hectares, contour modeling, earthwork balancing, and permanent cadastral monumentation.',
                ],
                'image_path' => null,
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'title' => [
                    'ar' => 'مبنى الرعاية الصحية التخصصية',
                    'en' => 'Specialized Healthcare Center',
                ],
                'category' => [
                    'ar' => 'مباني طبية وصحية',
                    'en' => 'Medical & Healthcare',
                ],
                'client' => [
                    'ar' => 'شركة الشفاء للخدمات الطبية',
                    'en' => 'Al-Shifa Medical Services',
                ],
                'location' => [
                    'ar' => 'بنغازي - شارع دبي',
                    'en' => 'Benghazi - Dubai Street',
                ],
                'area' => '8,200 م²',
                'status' => 'ongoing',
                'completion_date' => '2026-10-01',
                'description' => [
                    'ar' => 'التصميم الهندسي المتخصص لمجمع طبي جراحي متقدم يشمل غرف عمليات رقمية وعزل إشعاعي، مع إعداد دفاتر الشروط والمواصفات ومتابعة مقايسات التنفيذ الميداني.',
                    'en' => 'Specialized structural, MEP, and architectural design for an acute healthcare facility including digital operating suites, radiology shielding, BOQ development, and contractor supervision.',
                ],
                'image_path' => null,
                'is_featured' => true,
                'order' => 4,
            ],
            [
                'title' => [
                    'ar' => 'إعادة تأهيل وتطوير مبنى المقر الرئيسي التاريخي',
                    'en' => 'Historic Heritage Headquarters Rehabilitation',
                ],
                'category' => [
                    'ar' => 'ترميم وتدعيم إنشائي',
                    'en' => 'Restoration & Retrofit',
                ],
                'client' => [
                    'ar' => 'المؤسسة الوطنية للتنمية العمرانية',
                    'en' => 'National Urban Development Corp',
                ],
                'location' => [
                    'ar' => 'طرابلس - المدينة القديمة',
                    'en' => 'Tripoli - Old City Center',
                ],
                'area' => '3,400 م²',
                'status' => 'completed',
                'completion_date' => '2025-03-30',
                'description' => [
                    'ar' => 'دراسة السلامة الإنشائية وتدعيم الأساسات والأعمدة التاريخية مع الحفاظ على الهوية المعمارية للمبنى وتحديث الأنظمة الكهربائية والميكانيكية وفق أعلى المعايير.',
                    'en' => 'Detailed non-destructive structural condition assessment, carbon-fiber foundation reinforcement, and heritage-sensitive refurbishment integrating modern high-efficiency HVAC and electrical services.',
                ],
                'image_path' => null,
                'is_featured' => true,
                'order' => 5,
            ],
            [
                'title' => [
                    'ar' => 'دراسة وتصميم مشروع طريق المحور الجنوبي',
                    'en' => 'Southern Arterial Corridor Infrastructure Study',
                ],
                'category' => [
                    'ar' => 'طرق وبنية تحتية',
                    'en' => 'Roads & Infrastructure',
                ],
                'client' => [
                    'ar' => 'مصلحة الطرق والجسور',
                    'en' => 'Roads & Bridges Authority',
                ],
                'location' => [
                    'ar' => 'المنطقة الغربية',
                    'en' => 'Western District',
                ],
                'area' => '24 كم طولي',
                'status' => 'ongoing',
                'completion_date' => '2026-12-15',
                'description' => [
                    'ar' => 'إجراء الدراسات الهيدرولوجية والمساحية وحسابات التربة لمسار طريق مزدوج بطول 24 كم، يشمل تصميم الجسور وقنوات تصريف مياه الأمطار وإعداد المقايسات الفنية.',
                    'en' => 'Hydrological, geotechnical, and geometric design for a 24-kilometer dual-carriageway corridor, incorporating grade-separated interchange bridges, drainage culverts, and tender document compilation.',
                ],
                'image_path' => null,
                'is_featured' => true,
                'order' => 6,
            ],
        ];

        foreach ($projects as $proj) {
            Project::create($proj);
        }

        // 4. Seed Correspondences & Documents Archive
        Correspondence::truncate();
        $docs = [
            [
                'reference_number' => 'ANMAT-OUT-2026-0001',
                'type' => 'outgoing',
                'subject' => 'إحالة التقرير الفني النهائي لأعمال الرفع المساحي - مشروع برج الأعمال',
                'sender' => 'أنماط للأعمال والاستشارات الهندسية - الإدارة الفنية',
                'receiver' => 'شركة الاستثمارات العقارية الوطنية - مكتب المشروعات',
                'date_issued' => '2026-01-14',
                'status' => 'closed',
                'priority' => 'normal',
                'physical_location' => 'خزانة أ - رف 1 - ملف 08 (Tripoli Tower)',
                'tags' => 'مساحة, تقرير فني, برج الأعمال, إحالة',
                'notes' => 'تم تسليم النسخة الورقية المعتمدة مع القرص المدمج للبيانات الرقمية (CAD & GIS).',
            ],
            [
                'reference_number' => 'ANMAT-IN-2026-0002',
                'type' => 'incoming',
                'subject' => 'طلب اعتماد عينات حديد التسليح للمرحلة الأولى - مجمع الواحة',
                'sender' => 'شركة المقاولات العامة والإنشاءات',
                'receiver' => 'أنماط للاستشارات الهندسية - قسم الإشراف الميداني',
                'date_issued' => '2026-02-02',
                'status' => 'closed',
                'priority' => 'urgent',
                'physical_location' => 'خزانة ب - رف 2 - ملف 14 (Al-Waha Project)',
                'tags' => 'اعتماد مواد, حديد تسليح, مختبر مواد, الواحة',
                'notes' => 'تم فحص شهادات المنشأ واختبارات الشد في المختبر الوطني واعتماد العينة بملاحظات.',
            ],
            [
                'reference_number' => 'ANMAT-OUT-2026-0003',
                'type' => 'outgoing',
                'subject' => 'كتاب رسمي بخصوص اعتماد المستخلص الجاري رقم (4) لمشروع الرعاية الصحية',
                'sender' => 'أنماط للأعمال والاستشارات الهندسية - إدارة العقود والمستخلصات',
                'receiver' => 'شركة الشفاء للخدمات الطبية - الإدارة المالية',
                'date_issued' => '2026-02-28',
                'status' => 'pending_action',
                'priority' => 'normal',
                'physical_location' => 'خزانة ج - رف 1 - ملف 03 (Healthcare Medical)',
                'tags' => 'مستخلص, تدقيق كميات, مستحقات مالية',
                'notes' => 'المستخلص مدقق بالكامل ومرفق به جداول الحصر المعتمدة من مهندس الموقع.',
            ],
            [
                'reference_number' => 'ANMAT-INT-2026-0004',
                'type' => 'internal',
                'subject' => 'مذكرة داخلية بشأن جدولة الزيارات الميدانية لأجهزة الرصد المساحي GPS',
                'sender' => 'رئيس قسم المساحة والجيوديسيا',
                'receiver' => 'المدير العام والمهندسون الميدانيون',
                'date_issued' => '2026-03-10',
                'status' => 'archived',
                'priority' => 'normal',
                'physical_location' => 'خزانة م - رف 4 - أرشيف المذكرات الداخلية',
                'tags' => 'مذكرة داخلية, أجهزة مساحة, صيانة دورية',
                'notes' => 'تم توزيع فرق العمل وتحديث معايرة الأجهزة في المختبر المتخصص.',
            ],
            [
                'reference_number' => 'ANMAT-REP-2026-0005',
                'type' => 'technical_report',
                'subject' => 'تقرير فحص السلامة الإنشائية واختبار الموجات فوق الصوتية للخرسانة',
                'sender' => 'فريق الفحص الجيوتقني والإنشائي - أنماط',
                'receiver' => 'المؤسسة الوطنية للتنمية العمرانية',
                'date_issued' => '2026-03-15',
                'status' => 'closed',
                'priority' => 'urgent',
                'physical_location' => 'خزانة د - رف 3 - ملف التدعيم والترميم',
                'tags' => 'فحص خرسانة, سلامة إنشائية, تقرير معتمد',
                'notes' => 'أظهرت النتائج سلامة العناصر الحاملة مع التوصية بإجراء تدعيم سطحي للعمود C12.',
            ],
        ];

        foreach ($docs as $doc) {
            Correspondence::create($doc);
        }

        // 5. Seed Inquiries
        Inquiry::truncate();
        $inquiries = [
            [
                'name' => 'م. طارق المحمودي',
                'email' => 'tariq.mahmoudi@al-inmaa.ly',
                'phone' => '+218 91 123 4567',
                'service' => 'الأعمال والمساحة الطبوغرافية',
                'subject' => 'طلب عرض أسعار للرفع المساحي لمخطط سكني بمساحة 15 هكتار',
                'message' => 'نود الاستفسار عن التكلفة التقديرية والجدول الزمني لإجراء رفع طبوغرافي شامل وتثبيت نقاط إحداثيات GPS لمشروع سكني في ضواحي طرابلس.',
                'status' => 'new',
                'admin_notes' => null,
            ],
            [
                'name' => 'د. سالم الورفلي',
                'email' => 'salem.warfalli@invest.ly',
                'phone' => '+218 92 555 7890',
                'service' => 'التصميم الإنشائي ودراسات الأحمال',
                'subject' => 'استشارة هندسية لمبنى تجاري بارتفاع 8 طوابق',
                'message' => 'لدينا قطعة أرض تجارية ونرغب في التعاقد معكم لعمل التصاميم الإنشائية وحساب الأحمال ومتابعة التراخيص اللازمة.',
                'status' => 'contacted',
                'admin_notes' => 'تم الاتصال بالعميل وإرسال البروفايل التعريفي بالبريد الإلكتروني.',
            ],
        ];

        foreach ($inquiries as $inq) {
            Inquiry::create($inq);
        }
    }
}
