import Footer from "./footer";
import NavigationBar from "./navigation-bar";

export default function Layout({ children }: { children: React.ReactNode }) {
    return (
        <>
            <NavigationBar />
            {children}
            <Footer />
        </>
    );
}
