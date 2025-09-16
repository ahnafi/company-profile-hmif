import { NavigationItem } from '@/types';
import { Link, router } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import navigation from '../../data/navigation';

export default function NavigationBar() {
    const [isMenuOpen, setIsMenuOpen] = useState(false);
    const [activeDropdown, setActiveDropdown] = useState(null);
    const [isDarkMode, setIsDarkMode] = useState(() => {
        if (typeof window !== 'undefined' && localStorage.getItem('color-theme')) {
            return localStorage.getItem('color-theme') === 'dark';
        }
        return typeof window !== 'undefined' ? window.matchMedia('(prefers-color-scheme: dark)').matches : false;
    });
    const [isScrolled, setIsScrolled] = useState(false);
    const [currentPath, setCurrentPath] = useState('');

    // Get current path from window location
    useEffect(() => {
        if (typeof window !== 'undefined') {
            setCurrentPath(window.location.pathname);
        }
    }, []);

    // Listen to Inertia navigation changes
    useEffect(() => {
        const handleNavigation = () => {
            setCurrentPath(window.location.pathname);
        };

        const unsubscribe = router.on('navigate', handleNavigation);
        return () => {
            unsubscribe();
        };
    }, []);

    useEffect(() => {
        const root = document.documentElement;
        if (isDarkMode) {
            root.classList.add('dark');
            if (typeof window !== 'undefined') {
                localStorage.setItem('color-theme', 'dark');
            }
        } else {
            root.classList.remove('dark');
            if (typeof window !== 'undefined') {
                localStorage.setItem('color-theme', 'light');
            }
        }
    }, [isDarkMode]);

    useEffect(() => {
        const handleScroll = () => {
            setIsScrolled(window.scrollY > 0);
        };

        if (typeof window !== 'undefined') {
            window.addEventListener('scroll', handleScroll);
            return () => {
                window.removeEventListener('scroll', handleScroll);
            };
        }
    }, []);

    const toggleTheme = () => {
        setIsDarkMode((prevMode) => !prevMode);
    };

    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    const handleDropdownToggle = (index: any) => {
        setActiveDropdown(activeDropdown === index ? null : index);
    };

    const isActiveRoute = (route: NavigationItem) => {
        if (route.path) {
            return currentPath === route.path;
        }
        if (route.paths) {
            return route.paths.some((subRoute) => currentPath === subRoute.path);
        }
        return false;
    };

    const isActiveSubRoute = (path: string) => {
        return currentPath === path;
    };

    // Close dropdown when clicking outside
    useEffect(() => {
        const handleClickOutside = () => {
            setActiveDropdown(null);
        };

        if (typeof window !== 'undefined') {
            document.addEventListener('click', handleClickOutside);
            return () => document.removeEventListener('click', handleClickOutside);
        }
    }, []);

    return (
        <nav
            id="navbar"
            className={`section-padding-x normal-font-size fixed top-0 z-[998] w-full text-dark-base transition-all duration-300 ${
                isScrolled ? 'shadow-md backdrop-blur-md' : 'shadow-none lg:bg-transparent'
            } bg-transparent py-4 shadow-md backdrop-blur-md dark:bg-transparent dark:text-light-base dark:shadow-md dark:backdrop-blur-md`}
        >
            <div className="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between">
                <a href="#">
                    <img src="/img/logos/hmif.png" className="w-16" alt="Logo HMIF" />
                </a>
                <button
                    type="button"
                    className="relative z-[999] text-dark-base focus:outline-none xl:hidden dark:text-light-base"
                    onClick={() => setIsMenuOpen(!isMenuOpen)}
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" className="w-8" viewBox="0 0 448 512">
                        <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
                    </svg>
                </button>
                <div className={`w-full xl:block xl:w-auto ${isMenuOpen ? 'block' : 'hidden'}`}>
                    <ul className="mt-4 flex flex-col gap-2 rounded-lg border border-gray-400 p-4 font-medium xl:mt-0 xl:flex-row xl:gap-4 xl:border-none xl:p-0 rtl:space-x-reverse dark:border-gray-200">
                        {navigation.map((route, index) => (
                            <li key={index} className="relative">
                                {route.path ? (
                                    route.path.startsWith('http') || route.path.startsWith('https') ? (
                                        <a
                                            href={route.path}
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            className={`block rounded px-3 py-2 transition-colors duration-200 ${
                                                route.title === 'Jutif'
                                                    ? 'gradient-to-r bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary text-light-base'
                                                    : isActiveRoute(route)
                                                      ? 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300'
                                                      : 'hover:bg-gray-100 dark:hover:bg-gray-700'
                                            }`}
                                        >
                                            {route.title}
                                        </a>
                                    ) : (
                                        <Link
                                            href={route.path}
                                            className={`block rounded px-3 py-2 transition-colors duration-200 ${
                                                route.title === 'Jutif'
                                                    ? 'gradient-to-r bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary text-light-base'
                                                    : isActiveRoute(route)
                                                      ? 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300'
                                                      : 'hover:bg-gray-100 dark:hover:bg-gray-700'
                                            }`}
                                        >
                                            {route.title}
                                        </Link>
                                    )
                                ) : (
                                    <div className="relative">
                                        <button
                                            onClick={(e) => {
                                                e.stopPropagation();
                                                handleDropdownToggle(index);
                                            }}
                                            className={`flex w-full items-center justify-between rounded px-3 py-2 transition-colors duration-200 lg:w-auto ${
                                                isActiveRoute(route)
                                                    ? 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300'
                                                    : 'hover:bg-gray-100 dark:hover:bg-gray-700'
                                            }`}
                                        >
                                            <span>{route.title}</span>
                                            <svg
                                                className={`ml-1 h-4 w-4 transition-transform duration-200 ${
                                                    activeDropdown === index ? 'rotate-180' : ''
                                                }`}
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fillRule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clipRule="evenodd"
                                                />
                                            </svg>
                                        </button>

                                        {/* Dropdown menu */}
                                        <div
                                            className={`${
                                                activeDropdown === index ? 'block' : 'hidden'
                                            } absolute top-full left-0 z-50 mt-1 w-48 rounded-md border border-gray-200 bg-white shadow-lg lg:right-0 lg:left-auto dark:border-gray-600 dark:bg-gray-800`}
                                        >
                                            <div className="py-1">
                                                {route.paths?.map((subRoute, subIndex) => (
                                                    <Link
                                                        key={subIndex}
                                                        href={subRoute.path}
                                                        className={`block px-4 py-2 text-sm transition-colors duration-200 ${
                                                            isActiveSubRoute(subRoute.path)
                                                                ? 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300'
                                                                : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700'
                                                        }`}
                                                        onClick={() => {
                                                            setActiveDropdown(null);
                                                            setIsMenuOpen(false);
                                                        }}
                                                    >
                                                        {subRoute.title}
                                                    </Link>
                                                ))}
                                            </div>
                                        </div>
                                    </div>
                                )}
                            </li>
                        ))}
                        <li>
                            <button
                                id="theme-toggle"
                                type="button"
                                onClick={toggleTheme}
                                className="w-fit cursor-pointer rounded-lg border border-gray-400 px-3 py-2 text-sm text-gray-500 transition-all duration-300 hover:bg-gray-100 focus:outline-none dark:border-gray-200 dark:text-gray-400 dark:hover:bg-gray-700"
                            >
                                {isDarkMode ? (
                                    <svg
                                        id="theme-toggle-light-icon"
                                        className="h-5 w-5"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                            fillRule="evenodd"
                                            clipRule="evenodd"
                                        ></path>
                                    </svg>
                                ) : (
                                    <svg
                                        id="theme-toggle-dark-icon"
                                        className="h-5 w-5"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                    </svg>
                                )}
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    );
}
