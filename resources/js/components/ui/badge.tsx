import React from 'react';
import { cn } from '@/lib/utils';

interface BadgeProps extends React.HTMLAttributes<HTMLDivElement> {
    variant?: 'default' | 'secondary' | 'destructive' | 'outline';
}

const getBadgeClasses = (variant: 'default' | 'secondary' | 'destructive' | 'outline' = 'default') => {
    const baseClasses = "inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2";
    
    const variantClasses: Record<string, string> = {
        default: "border-transparent bg-blue-600 text-white hover:bg-blue-700",
        secondary: "border-transparent bg-gray-100 text-gray-900 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700",
        destructive: "border-transparent bg-red-600 text-white hover:bg-red-700",
        outline: "text-gray-900 border-gray-300 dark:text-gray-100 dark:border-gray-700",
    };
    
    return cn(baseClasses, variantClasses[variant]);
};

export function Badge({ className, variant = 'default', ...props }: BadgeProps) {
    return (
        <div className={cn(getBadgeClasses(variant), className)} {...props} />
    );
}