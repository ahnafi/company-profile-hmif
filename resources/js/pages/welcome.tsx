import Layout from '@/components/layout';
import HeroSection from '@/components/welcome/hero';
// import ValuesSection from '@/components/welcome/values';
import CabinetSection from '@/components/welcome/cabinet-section';
import LogoPhilosophySection from '@/components/welcome/logo-philosophy-section';
import MajorEventsSection from '@/components/welcome/major-events-section';
import LatestFormsSection from '@/components/welcome/latest-forms-section';
import YouTubeVideosSection from '@/components/welcome/youtube-videos';
// import AchievementsSection from './about-hmif/achievements';

interface Form {
    id: number;
    title: string;
    slug: string;
    thumbnail: string | null;
    description: string;
    start_date: string;
    end_date: string;
    is_active: boolean;
}

interface WelcomeProps {
    forms: Form[];
}

export default function Welcome({ forms }: WelcomeProps) {
    return (
        <Layout>
            <HeroSection />
            <CabinetSection />
            <LogoPhilosophySection />
            <MajorEventsSection />
            <LatestFormsSection forms={forms} />
            {/* <ValuesSection /> */}
            {/* <AchievementsSection /> */}
            <YouTubeVideosSection />
        </Layout>
    );
}
