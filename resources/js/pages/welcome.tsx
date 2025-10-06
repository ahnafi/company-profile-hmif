import Layout from '@/components/layout';
import HeroSection from '@/components/welcome/hero';
// import ValuesSection from '@/components/welcome/values';
import CabinetSection from '@/components/welcome/cabinet-section';
import LogoPhilosophySection from '@/components/welcome/logo-philosophy-section';
import MajorEventsSection from '@/components/welcome/major-events-section';
import YouTubeVideosSection from '@/components/welcome/youtube-videos';
// import AchievementsSection from './about-hmif/achievements';

export default function Welcome() {
    return (
        <Layout>
            <HeroSection />
            <CabinetSection />
            <LogoPhilosophySection />
            <MajorEventsSection />
            {/* <ValuesSection /> */}
            {/* <AchievementsSection /> */}
            <YouTubeVideosSection />
        </Layout>
    );
}
